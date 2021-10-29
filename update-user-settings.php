<?php
require_once "connect.php";

$query = "UPDATE `users` SET `accountName` = '{$_POST['accountName']}' WHERE `users`.`userID` = 2";

$user_data = [
    'accountName',
    'name',
    'email',
    'website',
    'country',
    'motto',
    'aboutMe'
];

foreach ($user_data as $key => $value) {
    if (isset($_POST[$value])) {
        $query = "UPDATE `users` SET `$value` = '{$_POST[$value]}' WHERE `users`.`userID` = 2";
        mysqli_query($polaczenie, $query) or die(mysqli_error($polaczenie));
    }
}

header('Location: ' . 'dashboard-setting.php');
