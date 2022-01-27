<?php
require_once "inc/connect.php";
require_once "inc/user.php";

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['add_publication'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION["user_id"];
        $user = get_user($user_id, $db);
        $email = $user['email'];

        insert_publication_data($db, $user_id);
        //upload_publication_files();
        //create_publication_preview();
    }
    //header('Location: publications-grid.php');

}

function insert_publication_data($db, $user_id)
{
    echo $_POST['category'];
    echo $_POST['title'];
    echo $_POST['abstract'];
    echo $_POST['publication_description'];
    $query = mysqli_prepare(
        $db,
        "INSERT INTO publications (sender_id, category, title, abstract, description) VALUES (?, ?, ?, ?, ?)"
    );
    mysqli_stmt_bind_param(
        $query,
        'issss',
        $user_id,
        $_POST['category'],
        $_POST['title'],
        $_POST['abstract'],
        $_POST['publication_description'],
    );
    mysqli_stmt_execute($query);
    //header('Location: publications-grid.php');
}

function upload_publication_files($user_id)
{
    //"publication_cover_jpg", "publication_pdf_file"
    $publication_cover_src = handle_file($publication_cover_jpg, $user_id);
    $publication_pdf_src = handle_file($publication_pdf_file, $user_id);
    $publication_folder_src = handle_directory($user_id);
    //$upload_date = date("Y-m-d");
    $upload_date = date("Y-m-d_(h-i)");
    /*
    if (!file_exists("users/" . $user_id . "/publications/" . $file_date . "/")) {
        @mkdir("users");
        @mkdir("users/" . $user_id);
        @mkdir("users/" . $user_id . "/publications/");
        @mkdir("users/" . $user_id . "/publications/" . $file_date);
    }
    */
    $target_dir = "users/" . $user_id . "/publications/" . $file_date . "/";
    return $target_dir;
}

function handle_file($file_type, $user_id)
{
    $target_dir = handle_directory($user_id);
    $target_file = $target_dir . basename($_FILES[$file_type]["name"]);
    $uploadCheck = 0;

    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    echo "<br>";
    echo $image_file_type . " <= typ<br>";
    echo $_FILES[$file_type]["name"] . "<br>";
    echo $_FILES[$file_type]["tmp_name"] . "<br>";
    echo $_FILES[$file_type]["size"] . "<br>";

    // Check if image file is a actual image or fake image   
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Przepraszamy, plik o tej nazwie już ustnieje.";
        $uploadCheck = 1;
    }
    // Check file size
    if ($_FILES[$file_type]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadCheck = 1;
    }
    // Allow certain file formats
    if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "pdf") {
        echo "Sorry, only JPG, JPEG, PDF files are allowed.";
        $uploadCheck = 1;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadCheck == 1) {
        echo "<br>Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$file_type]["tmp_name"], $target_file)) {
            echo "<br>The file " . basename($_FILES[$file_type]["name"]) . " has been uploaded.";
        } else {
            echo "<br>Sorry, there was an error uploading your file.";
        }
    }
    if ($image_file_type == "pdf") {
        convert_pdf_to_jpg($target_file, $target_dir);
    }
    return $target_file;
}

function create_publication_preview()
{
}

function convert_pdf_to_jpg($pdf_src, $target_dir)
{
    try {
        $im = new Imagick();
        $resolution = 300;
        $im->setResolution($resolution, $resolution);

        $im->readimage($pdf_src . '[0]');
        $im->setImageFormat('jpeg');
        $im->writeImage($target_dir . '/pageone.jpg');
        $im->clear();
        $im->destroy();

        $im->readimage($pdf_src . '[1]');
        $im->setImageFormat('jpeg');
        $im->writeImage($target_dir . '/pagetwo.jpg');
        $im->clear();
        $im->destroy();
    } catch (ImagickException $e) {
        var_dump($e);
    }
    echo "JPG generated.<br>";
}


/*
    $random_number = rand(100, 99999);
    $anonymous_publication_file_name = "anonymous_publication" . $random_number . "@" . $date . "-" . "CaseStudy";
*/