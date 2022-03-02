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
        $fetched_data = $result ? mysqli_fetch_assoc($result) : null;
        $current_date = date('Y-m-d H:i:s', time());

        if ($fetched_data['email'] && $fetched_data['drop_date'] > $current_date) {
            $query = mysqli_prepare($db, "UPDATE password_reset SET drop_date=null WHERE token=?");
            mysqli_stmt_bind_param($query, 's', $token);
            mysqli_stmt_execute($query);
            $rows_affected_1 = mysqli_stmt_affected_rows($query);
            //change password
            $hashed_password = md5($password1);
            $query = mysqli_prepare($db, "UPDATE users SET password=? WHERE email=?");
            mysqli_stmt_bind_param($query, 'ss', $hashed_password, $fetched_data['email']);
            mysqli_stmt_execute($query);
            $rows_affected_2 = mysqli_stmt_affected_rows($query);

            // Check if password changed succesfully.
            if ($rows_affected_1 > 0 && $rows_affected_2 > 0) {
                header('location: ../../index.php');
            }
        } else {
            die("Error changing password 1.");
        }
    }
} else {
    die("Error changing password 2.");
}
