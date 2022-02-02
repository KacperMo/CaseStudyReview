<?php
require_once "inc/connect.php";
require_once "inc/user.php";

if (!isset($_SESSION)) {
    session_start();
}
function get_publication($db, $publication_id)
{
    $query = mysqli_prepare(
        $db,
        "SELECT * FROM publications
        WHERE publication_id=?
        "
    );
    mysqli_stmt_bind_param(
        $query,
        'i',
        $publication_id,
    );
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    $publication = mysqli_fetch_assoc($result);
    return $publication;
}
function get_publications($db)
{
    /* Return all publications. */
    $query = mysqli_prepare(
        $db,
        "SELECT * FROM publications
        LEFT JOIN user_data ON sender_id=user_id
        "
    );
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    $publications  = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($publications, $row);
    }
    return $publications;
}
if (isset($_POST['add_publication'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION["user_id"];
        $user = get_user($user_id, $db);

        // insert publication data into database and get id of created record
        insert_publication_data($user_id, $db);
        $publication_id = mysqli_insert_id($db);

        //create publication folder
        $publication_path = "users/" . $user_id . "/publications/" . $publication_id . "/";
        mkdir($publication_path);

        // upload publication pdf and publication cover
        $publication_path = upload_file(
            $user_id,
            $publication_id,
            'publication_pdf',
            ['pdf'],
        );
        $publication_cover_path = upload_file(
            $user_id,
            $publication_id,
            'publication_cover',
            ['png', 'jpg', 'jpeg'],
        );
        update_publication_files_paths($db, $publication_id, $publication_path, $publication_cover_path);

        //  create publication preview
        $full_publication_dir = $_SERVER['DOCUMENT_ROOT'] . "/users/" . $user_id . "/publications/" . $publication_id . "/";
        $full_publication_file_path = $full_publication_dir . 'publication_pdf' . "_" . $publication_id . ".pdf";
        convert_pdf_to_jpg($full_publication_file_path, 1);
    }
    //header('Location: publications-grid.php');
}

function insert_publication_data($user_id, $db)
{
    $query = mysqli_prepare(
        $db,
        "INSERT INTO publications (sender_id, category, title, abstract, description) 
            VALUES (?, ?, ?, ?, ?)
            "
    );
    mysqli_stmt_bind_param(
        $query,
        'issss',
        $user_id,
        $_POST['category'],
        $_POST['title'],
        $_POST['abstract'],
        $_POST['description'],
    );
    mysqli_stmt_execute($query);
}
function update_publication_files_paths($db, $publication_id, $publication_path, $publication_cover_path)
{
    $query = mysqli_prepare(
        $db,
        "UPDATE publications SET publication_path=?, cover_path=? WHERE publication_id=? "
    );
    mysqli_stmt_bind_param(
        $query,
        'ssi',
        $publication_path,
        $publication_cover_path,
        $publication_id,
    );
    mysqli_stmt_execute($query);
}
function upload_file($user_id, $publication_id, $file_name, $file_types)
{
    $target_dir = "users/" . $user_id . "/publications/" . $publication_id . "/";
    $upload_failed = false;
    $file_type = strtolower(
        pathinfo(basename($_FILES[$file_name]["name"]), PATHINFO_EXTENSION)
    );
    $target_file = $target_dir . $file_name . "_" . $publication_id . '.' . $file_type;
    // Check file size
    if ($_FILES[$file_name]["size"] > 15000000) {
        echo "Sorry, your file is too large.";
        $upload_failed = true;
    }
    // Allow certain file formats
    if (in_array($file_type, $file_types) == false) {
        $upload_failed = true;
        echo "Wrong file format.";
    }
    if ($upload_failed) {
        echo "<br>Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
            echo "<br>The file " . basename($_FILES[$file_name]["name"]) . " has been uploaded.";
        } else {
            echo "<br>Sorry, there was an error uploading your file.";
        }
    }
    return $target_file;
}

function convert_pdf_to_jpg($pdf_src, $pages)
{
    try {
        $im = new Imagick();
        $resolution = 300;
        $im->setResolution($resolution, $resolution);
        for ($i = 0; $i < $pages; $i++) {
            $im->readimage($pdf_src . '[' . $i . ']');
            $im->setImageFormat('jpeg');
            $im->writeImage(substr($pdf_src, 0, -4) . '_preview_page(' . $i . ').jpg');
            $im->clear();
            $im->destroy();
        }
    } catch (ImagickException $e) {
        var_dump($e);
    }
    echo "JPG generated.<br>";
}
