<?php
require_once "../connect.php";

if (isset($_POST['password-submit'])) {
    $token = $_GET['token'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ($password1 == $password2) {
        // Get email if there is an active token.
        $query = mysqli_prepare($db, "SELECT email, drop_date FROM password_reset WHERE token=?");
        mysqli_stmt_bind_param($query, 's', $token);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        $fetched = mysqli_fetch_assoc($result);
        echo $fetched;

        $email_from_db = $result ? mysqli_fetch_assoc($result) : null;

        if ($email_from_db['email']) {
            //change password
            $hashed_password = $password1;
            $query = mysqli_prepare($db, "UPDATE users SET password=? WHERE email=?");
            mysqli_stmt_bind_param($query, 'ss', $hashed_password, $email_from_db);
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
            // Check if password changed succesfully.

            if ($result) {
                die("sukces");
            }
        } else {
            die("nie bardzo");
        }
    }
    //header('location: password-change.php?token=' . $token);
} else {
    //throw error
    //header('location: password-change.php?token=' . $token . '&error=001');
}
