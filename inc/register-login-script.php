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

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {
        array_push($errors, "Nazwa użytkownika jest wymagana");
    }
    if (empty($email)) {
        array_push($errors, "Email jest wymagany");
    }
    if (empty($password_1)) {
        array_push($errors, "Hasło jest wymagane");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Hasła nie są takie same.");
    }

    $password = md5($password_1);

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email

    // binding
    // mysqli_stmt_bind_result($user_check_query, $username, $email, $password);

    $user_check_query = mysqli_prepare($db, "SELECT username, email, password FROM users WHERE username=? OR email=? LIMIT 1");
    mysqli_stmt_bind_param($user_check_query, 'ss', $username, $email);
    mysqli_stmt_execute($user_check_query);
    $result = mysqli_stmt_get_result($user_check_query);
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

        // Add user to database
        $query = mysqli_prepare($db, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($query, 'sss', $username, $email, $password);
        mysqli_stmt_execute($query);

        // Get the id of just created user
        $query = mysqli_prepare($db, "SELECT user_id FROM users WHERE email=? AND password=?");
        mysqli_stmt_bind_param($query, 'ss', $email, $password);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        $user = $result ? mysqli_fetch_assoc($result) : null;

        // create record in user_data for created user
        $query = mysqli_prepare($db, "INSERT INTO user_data (user_id, college) VALUES (?, ?)");
        mysqli_stmt_bind_param($query, 'is', $user['user_id'], $college);
        mysqli_stmt_execute($query);

        create_user_folder($user['user_id']);
        header('location: login.php');
    }
}

// LOGIN USER

if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Email jest wymagany");
    }
    if (empty($password)) {
        array_push($errors, "Hasło jest wymagane");
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
