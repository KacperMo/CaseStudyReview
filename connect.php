<?php
$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "ubw";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

try {

    $pdo = new PDO('mysql:host=localhost; dbname=ubw; encoding=utf8', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
try {

    $pdo1 = new PDO('mysql:host=localhost; dbname=ubw; encoding=utf8', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo1->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
try {

    $pdo2 = new PDO('mysql:host=localhost; dbname=ubw; encoding=utf8', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo2->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
