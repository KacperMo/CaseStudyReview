<?php
require_once "connect.php";
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    $user_id =  $_SESSION["user_id"];
    $user = get_user($user_id, $db);
    $user_data = get_user_data($user_id, $db);
}

if (isset($_POST['update-user-settings'])) {
    $user_id =  $_SESSION["user_id"];

    $profile_image_path = upload_user_image($user_id, "profile_image", $db);
    $banner_image_path = upload_user_image($user_id, "banner_image", $db);
    
    switch(true)
    {
        case(empty($profile_image_path) && empty($banner_image_path)):
            $profile_image_path = $user_data['profile_image'];
            $banner_image_path = $user_data['banner_image'];
        
        case(empty($profile_image_path) && !empty($banner_image_path)):
            $profile_image_path = $user_data['profile_image'];
        
        case(!empty($profile_image_path) && empty($banner_image_path)):
            $banner_image_path = $user_data['banner_image'];

           
    }
    update_user_files_paths($db, $user_id, $profile_image_path, $banner_image_path);
    update_user_data($user_id, $db);
    header('Location: author.php');
}

function get_user($user_id, $db)
{
    $query = "SELECT * FROM `users` WHERE `users`.`user_id` = $user_id";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    return $result->fetch_assoc();
}
function get_user_data($user_id, $db)
{
    $query = "SELECT * FROM user_data WHERE user_id = $user_id";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    return $result->fetch_assoc();
}


function create_user_folder($user_id)
{
    $path = "users/$user_id";
    mkdir($path);
    $path = "users/$user_id/images";
    mkdir($path);
    $path = "users/$user_id/publications";
    mkdir($path);
}
function update_user_files_paths($db, $user_id, $profile_image_path, $banner_image_path)
{
    echo $profile_image_path." ". $banner_image_path;
    $query = mysqli_prepare(
        $db,
        "UPDATE user_data SET profile_image=?, banner_image=? WHERE user_id=? "
    );
    mysqli_stmt_bind_param(
        $query,
        'ssi',
        $profile_image_path,
        $banner_image_path,
        $user_id,
    );
    mysqli_stmt_execute($query);
}
function update_user_data($user_id, $db)
{
    $user_data = [
        'first_name',
        'surname',
        'college',
        'birth_date',
        'description',
        'country',
        'website',
    ];
    foreach ($user_data as $key => $value) {
        if (isset($_POST[$value])) {
            $query = "UPDATE `user_data` SET `$value` = '{$_POST[$value]}' WHERE `user_id` = $user_id";
            mysqli_query($db, $query) or die(mysqli_error($db));
        }
    }
}

function upload_user_image($user_id, $file_name, $db)
{
    // Check if user uploaded file
    if (!empty($_FILES[$file_name]) && $_FILES[$file_name]["name"] != "") {

        $max_file_size = 15000000;
        $target_dir = "users/" . $user_id . "/images/";
        $target_file = $target_dir . basename($_FILES[$file_name]["name"]);
        $upload_ok = 1;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES[$file_name]["tmp_name"]);
            if ($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $upload_ok = 1;
            } else {
                //echo "File is not an image.";
                $upload_ok = 0;
            }
        }

        // Check if user uploaded file
        if ($_FILES[$file_name] == "") {
            //echo "No file uploaded";
            $upload_ok = 0;
        }
        // Check file size
        if ($_FILES[$file_name]["size"] > $max_file_size) {
            // echo "Sorry, your file is too large.";
            $upload_ok = 0;
        }

        // Allow certain file formats
        if (
            $image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg"
            && $image_file_type != "gif"
        ) {
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_ok = 0;
        }

        // Check if $upload_ok is set to 0 by an error
        if ($upload_ok == 0) {
            //echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            $final_file_name = $file_name . '.jpg';
            $final_path = $target_dir . $final_file_name;
            if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $final_path)) {
                $query = "UPDATE `user_data` SET `$file_name` = '$final_path' WHERE `user_id` = $user_id";
                mysqli_query($db, $query) or die(mysqli_error($db));
                //echo "The file " . htmlspecialchars(basename($_FILES[$file_name]["name"])) . " has been uploaded.";
            } else {
                //echo "Sorry, there was an error uploading your file.";
            }
            return $final_path;
        }
    }
}
