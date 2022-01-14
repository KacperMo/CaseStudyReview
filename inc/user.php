<?php
require_once "connect.php";
if (!isset($_SESSION)) {
    session_start();
}
$user_id =  $_SESSION["user_id"];

if (isset($_GET['function'])) {
    switch ($_GET['function']) {
        case 'update_user_data':
            update_user_data($user_id, $mysqli_connection);
            upload_user_image($user_id, "profile_image");
            upload_user_image($user_id, "banner_image");
            break;
    }
}


function get_user($user_id, $mysqli_connection)
{
    $query = "SELECT * FROM `users` WHERE `users`.`userID` = $user_id";
    $result = mysqli_query($mysqli_connection, $query) or die(mysqli_error($mysqli_connection));
    return $result->fetch_assoc();
}

function create_user_folder($user_id)
{
    $path = '/users/{$user_id}/';
    mkdir($path, 0777, true);
    $path = '/users/{$user_id}/images';
    mkdir($path, 0777, true);
    $path = '/users/{$user_id}/publications';
    mkdir($path, 0777, true);
}

function update_user_data($user_id, $mysqli_connection)
{
    $data = [
        'accountName',
        'name',
        'email',
        'website',
        'country',
        'motto',
        'aboutMe'
    ];
    foreach ($data as $key => $value) {
        if (isset($_POST[$value])) {
            $query = "UPDATE `users` SET `$value` = '{$_POST[$value]}' WHERE `users`.`userID` = $user_id";
            mysqli_query($mysqli_connection, $query) or die(mysqli_error($mysqli_connection));
        }
    }
}

function upload_user_image($user_id, $file_name)
{
    // Check if user uploaded file
    if ($_FILES[$file_name]["name"] != "") {

        $max_file_size = 50000000;
        $target_dir = "../users/" . $user_id . "/images//";
        $target_file = $target_dir . basename($_FILES[$file_name]["name"]);
        $upload_ok = 1;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES[$file_name]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $upload_ok = 1;
            } else {
                echo "File is not an image.";
                $upload_ok = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $upload_ok = 0;
        }
        // Check if user uploaded file
        if ($_FILES[$file_name] == "") {
            echo "No file uploaded";
            $upload_ok = 0;
        }
        // Check file size
        if ($_FILES[$file_name]["size"] > $max_file_size) {
            echo "Sorry, your file is too large.";
            $upload_ok = 0;
        }

        // Allow certain file formats
        if (
            $image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg"
            && $image_file_type != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_ok = 0;
        }

        // Check if $upload_ok is set to 0 by an error
        if ($upload_ok == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            $final_file_name = $file_name . substr($_FILES[$file_name]["name"], strpos($_FILES[$file_name]["name"], ".", +1));
            if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_dir . "/" . $final_file_name)) {
                echo "The file " . htmlspecialchars(basename($_FILES[$file_name]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
