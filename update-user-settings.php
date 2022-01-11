<?php
require_once "connect.php";
session_start();

$userID = $_SESSION["userID"];

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
        $query = "UPDATE `users` SET `$value` = '{$_POST[$value]}' WHERE `users`.`userID` = $userID";
        mysqli_query($polaczenie, $query) or die(mysqli_error($polaczenie));
    }
}
uploadUserImage($userID,"banner_image");
uploadUserImage($userID,"profile_image");

header('Location: ' . 'dashboard-setting.php');

function uploadUserImage($userID, $fileName){
    // Check if user uploaded file
    if($_FILES[$fileName]["name"]!=""){
       
    $maxFileSize = 50000000;
    $target_dir = "user_data/".$userID."/images//";
    $target_file = $target_dir . basename($_FILES[$fileName]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$fileName]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check if user uploaded file
    if($_FILES[$fileName]==""){
        echo "No file uploaded";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES[$fileName]["size"] > $maxFileSize) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        $finalFileName = $fileName.substr($_FILES[$fileName]["name"], strpos($_FILES[$fileName]["name"],".",+1));
        if (move_uploaded_file($_FILES[$fileName]["tmp_name"], $target_dir."/". $finalFileName)) {
            echo "The file " . htmlspecialchars(basename($_FILES[$fileName]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
}