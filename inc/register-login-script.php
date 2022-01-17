<?php
require_once 'inc/connect.php';
require_once 'inc/user.php';

if (!isset($_SESSION)) {
    session_start();
}

// initializing variables
$username = "";
$email    = "";
$errors = array();

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Hasła nie są takie same.");
    }

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = $result ? mysqli_fetch_assoc($result) : null;

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Ta nazwa użytkownika jest zajęta.");
        }

        if ($user['email'] === $email) {
            array_push($errors, "Ten adres email jest zajęty.");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database

        $query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
        $result = mysqli_query($db, $query);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $user = $result->fetch_assoc();
        $query = "INSERT INTO user_data (user_id) 
  			  VALUES('{$user['user_id']}')";
        mysqli_query($db, $query);
        echo $user['user_id'];
        create_user_folder($user['user_id']);
        header('location: index.php');
    }
}

// LOGIN USER

if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $user = $results->fetch_assoc();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong email/password combination");
        }
    }
}
