<?php
if (isset($_POST['password-submit'])) {
    $email = $_POST['email'];
    $token = $_GET['token'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    //change if passwords match
    if ($password1 == $password2) {
        header('location: password-change.php?token=' . $token);
    } else {
        header('location: password-change.php?token=' . $token . '&error=001');
    }
    //check token
    $user_check_query = mysqli_prepare($db, "SELECT email FROM password_reset WHERE token=?");
    mysqli_stmt_bind_param($user_check_query, 's', $email);
    mysqli_stmt_execute($user_check_query);
    $result = mysqli_stmt_get_result($user_check_query);
    $token_from_db = $result ? mysqli_fetch_assoc($result) : null;
    if ($token == $token_from_db) {
    }
    //change password

}
