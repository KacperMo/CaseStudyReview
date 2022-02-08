<?php
require_once "inc/connect.php";
require_once "inc/user-scripts.php";

if (!isset($_SESSION)) {
    session_start();
}


if (isset($_POST['add_publication'])) {
    if (isset($_SESSION['user_id'])) {
        $user = get_user($_SESSION["user_id"], $db);
        // insert publication data into database and get id of created record
        insert_publication_data($_SESSION["user_id"], $db);
        $publication_id = mysqli_insert_id($db);

        //create publication folder
        $publication_path = "users/" . $_SESSION["user_id"] . "/publications/" . $publication_id . "/";
        mkdir($publication_path);

        // upload publication pdf and publication cover
        $publication_path = upload_file(
            $_SESSION["user_id"],
            $publication_id,
            'publication_pdf',
            ['pdf'],
        );
        $publication_cover_path = upload_file(
            $_SESSION["user_id"],
            $publication_id,
            'publication_cover',
            ['png', 'jpg', 'jpeg'],
        );

        //  create publication preview

        $publication_preview_path = convert_pdf_to_jpg($publication_path, 1);

        update_publication_files_paths($db, $publication_id, $publication_path, $publication_cover_path, $publication_preview_path);

        header('Location: publications-list.php');
    } else {
        header('Location: add-publication.php');
    }
}

function get_publication($db, $publication_id)
{
    $query = mysqli_prepare(
        $db,
        "SELECT * FROM publications
        LEFT JOIN user_data ON sender_id=user_id
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

function get_publications($db, $user_id = null)
{
    /* Get publications of a chosen user, if user ID is not provided, select all publications from database. */
    echo $user_id;
    if ($user_id) {
        $query = mysqli_prepare(
            $db,
            "SELECT * FROM publications
            LEFT JOIN user_data ON sender_id=user_id
            WHERE user_id=?
            "
        );
        mysqli_stmt_bind_param(
            $query,
            'i',
            $user_id,
        );
    } else {
        $query = mysqli_prepare(
            $db,
            "SELECT * FROM publications
            LEFT JOIN user_data ON sender_id=user_id
            "
        );
    }
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    $publications  = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($publications, $row);
    }
    return $publications;
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

function update_publication_files_paths($db, $publication_id, $publication_path, $publication_cover_path, $publication_preview_path)
{
    $query = mysqli_prepare(
        $db,
        "UPDATE publications SET publication_path=?, cover_path=?, publication_preview_path=? WHERE publication_id=? "
    );
    mysqli_stmt_bind_param(
        $query,
        'sssi',
        $publication_path,
        $publication_cover_path,
        $publication_preview_path,
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

function convert_pdf_to_jpg($relative_publication_pdf_path, $pages)
{
    /*
    Create images from pages of given pdf file.
    
    Note: Function converts relative file path to absolute because Imagick requires it.
    Warning: Currently function does not check how many pages actually exist in given pdf file,
    so if $pages parameter exceeds the number of pages in pdf file, function will crash.
    Warning: Currently function returns path only for the last image created.
    This has to be reworked so that function returns the general path to all created images.
    */
    $absolute_publication_pdf_path = $_SERVER['DOCUMENT_ROOT'] . "/" . $relative_publication_pdf_path;
    try {
        $im = new Imagick();
        $resolution = 300;
        $im->setResolution($resolution, $resolution);
        $relative_img_final_path = "";
        for ($i = 0; $i < $pages; $i++) {
            $im->readimage($absolute_publication_pdf_path . '[' . $i . ']');
            $im->setImageFormat('jpeg');
            // Prepare the end of image path.
            $img_path_end = '_preview_page(' . $i . ').jpg';
            // Prepare the relative path to an image, this will be returned
            // and used to create absolute path to the image.
            $relative_img_final_path = substr($relative_publication_pdf_path, 0, -4) . $img_path_end;
            $absolute_img_final_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $relative_img_final_path;
            $im->writeImage($absolute_img_final_path);
            $im->clear();
            $im->destroy();
        }
        // Return path to last converted page.
        return $relative_img_final_path;
    } catch (ImagickException $e) {
        var_dump($e);
    }
    //echo "JPG generated.<br>";
}
