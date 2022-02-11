<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

$email = $_POST['email'];

if (isset($email) && isset($_POST['email-submit'])) {
    if (empty(trim($email))) {
        header('location: ../../password-reset.php');
    } else {
        include('../connect.php');
        $user_check_query = mysqli_prepare($db, "SELECT email FROM users WHERE email=?");
        mysqli_stmt_bind_param($user_check_query, 's', $email);
        mysqli_stmt_execute($user_check_query);
        $result = mysqli_stmt_get_result($user_check_query);
        $user = $result ? mysqli_fetch_assoc($result) : null;

        if ($user) {
            $token = bin2hex(random_bytes(64));

            $user_token_query = mysqli_prepare($db, "INSERT INTO password_reset (token, email, drop_date) VALUES (?, ?, ADDTIME(CURRENT_TIMESTAMP(), '0:15:0'))");
            mysqli_stmt_bind_param($user_token_query, 'ss', $token, $user['email']);
            mysqli_stmt_execute($user_token_query);

            $mail = new PHPMailer(TRUE);
            $mail->CharSet = "utf-8";
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'ssl0.ovh.net;';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'casestudyreview@akayee.net';
            $mail->Password   = 'casestudy11';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $query = mysqli_prepare($db, "SELECT * FROM users WHERE email=? AND password=?");

            $mail->Encoding = 'base64';
            $mail->setFrom('casestudyreview@akayee.net', 'no-reply');
            $mail->addAddress($email);           // Add a recipient
            $mail->isHTML(true);
            $mail->Subject = 'Procedura resetowania hasła';
            $mail->Body    = '<p style="font-weight:800; font-size:20px">Case Study Review</p><br><p style="font-size:12px">Jeżeli widzisz tą wiadomość, oznacza to, że użyłeś procedury resetowania hasła. Jeżeli nie byłeś to ty, spokojnie, po prostu nie klikaj w żaden link w tej wiadomości.<br><br>Jeżeli chcesz zresetować swoje hasło, kliknij w link poniżej.</p>
            <p style="font-size:12px"><a href="localhost/casestudyreview/password-change.php?token=' . $token . '">localhost/casestudyreview/password-change.php?token=' . $token . '</a></p>';
            $mail->AltBody = 'Case Study Review. Jeżeli widzisz tą wiadomość oznacza to, że użyłeś procedury resetowania hasła. Jeżeli nie byłeś to ty, spokojnie, po prostu nie używaj linku podanego w następnym zdaniu. Jeżeli chcesz zresetować swoje hasło, wejdź w następujący link: localhost/casestudyreview/password-change.php?token=' . $token;
            $mail->send();
            die("wyslane.");
        } else {
            //udaj ze wysylasz maila
            die("wyslane xD");
        }
    }
} else {
    header('location: ../../index.php');
}
