<?php
//if($_SERVER["REQUEST_METHOD"] == "POST"){

$date = date("Y-m-d");
@session_start();
$user_id =  $_SESSION["user_id"];
// getting user date ------------------------------------------------
if (isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] == true)) {
    $user_email = $_SESSION["userEmail"];
    echo $user_email;
    $user_id = $_SESSION["user_id"];
} else {
    $user_id = 0;
    $random_number = rand(100, 99999);
    $user_email = "anonymous_publication" . $random_number . "@" . $date . "-" . "CaseStudy";
    echo $user_email;
}
// End of getting user date ------------------------------------------------


send_file_to_server("uploadJPG", "uploadPDF", $user_email, $user_id);
/* header('Location: solutions.php');
exit;  */


function send_file_to_server($jpg_file, $pdf_file, $user_email, $user_id)
{
    //$file_date = date ("Y-m-d_(h-i)");
    $jpg_src = handle_file($jpg_file, $user_email);
    $pdf_src = handle_file($pdf_file, $user_email);
    $src = handle_directory($user_email);


    //Testowe logi 
    /*    echo "<br><b>".date ("Y-m-d (h-i)")."</b><br>";
    echo "<br> jpg_src ======> ".$jpg_src;
    echo  "<br>pdf_src ======> ".$pdf_src;    
    echo  "<br>src ======> ".$src."-------------------------------------------------------";     */
    releaseSQL($jpg_src, $pdf_src, $user_email, $user_id, $src);
}

function releaseSQL($jpg_src, $pdf_src, $user_email, $user_id, $src)
{
    require "inc/connect.php";
    $date = date("Y-m-d");

    // Define variables and initialize with empty values 
    $Src = $src;
    $Title = strip_tags(trim($_POST["Title"]));
    //$Localization=strip_tags(trim($_POST["Localization"]));
    $Tags = strip_tags(trim($_POST["Tags"]));
    $abstract = strip_tags(trim($_POST["abstract"]));
    $category = strip_tags(trim($_POST["Category"]));
    //$retailBranch=strip_tags(trim($_POST["retailBranch"]));        
    $description = strip_tags(trim($_POST["description"]));
    @$author = strip_tags(trim($_POST["author"]));
    //dodać regółe jeżeli pole puste to author z sesji


    //$supervisor=strip_tags(trim($_POST["supervisor"]));
    $isPublic = strip_tags(trim($_POST["isPublic"]));
    //$agree=strip_tags(trim($_POST["agree"]));


    if (isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] == true)) {
        $author = $user_email;
    }
    echo "User ID:" . $user_id . "<br>";

    $required = array(
        'Title', 'Tags', 'Category',
        'description'
    );


    // Loop over field names, make sure each one exists and is not empty
    $error = false;
    foreach ($required as $field) {

        if (empty(strip_tags(trim(($_POST[$field]))))) {
            $error = true;
            //echo "<br>brakuje -> ".$_POST[$field]."albo".$field." <-<br>";
        } else {
            //echo "Jest -".$field."<br>";
        }
    }

    if ($error) {
        echo "Uzupełnij dane!";
    } else {
        echo "dodaje";
        // Prepare a select statement
        //$sql = "INSERT INTO `publications`( `authorID`,`date`,`IMGsrc`, `title`, `category`, `retailBranch`, `pdf_src`, `description`) VALUES ('$user_id', '$date','$jpg_src','$Title','$Tags','$Category','$pdf_src','$TextArea');";


        $sqlUploadPublication = "INSERT INTO `publications`( `isPublic`,`authorID`, `authornIFnotlLogIn`, `date`,`IMGsrc`, `title`, `category`, `pdf_src`, `src`, `description`, `abstract`) 
                                                    VALUES (:isPublic ,:userID, :authorIFnotlLogIn, :date, :jpg_src, :Title, :category, :pdf_src, :src, :description, :abstract);";

        $insert_publication_data = $pdo->prepare($sqlUploadPublication);
        $insert_publication_data->bindValue('isPublic', $isPublic, PDO::PARAM_INT);
        $insert_publication_data->bindValue('userID', $user_id, PDO::PARAM_STR);
        $insert_publication_data->bindValue('authorIFnotlLogIn', $author, PDO::PARAM_STR);
        //$insert_publication_data->bindValue('supervisor', $supervisor, PDO::PARAM_STR);
        $insert_publication_data->bindValue('date', $date, PDO::PARAM_STR);
        $insert_publication_data->bindValue('jpg_src', $jpg_src, PDO::PARAM_STR);
        $insert_publication_data->bindValue('Title', $Title, PDO::PARAM_STR);
        $insert_publication_data->bindValue('category', $category, PDO::PARAM_STR);
        //$insert_publication_data->bindValue('retailBranch', $retailBranch, PDO::PARAM_STR);
        $insert_publication_data->bindValue('pdf_src', $pdf_src, PDO::PARAM_STR);
        $insert_publication_data->bindValue('src', $Src, PDO::PARAM_STR);
        $insert_publication_data->bindValue('description', $description, PDO::PARAM_STR);
        //$insert_publication_data->bindValue('Tags', $Tags, PDO::PARAM_STR);             
        $insert_publication_data->bindValue('abstract', $abstract, PDO::PARAM_STR);
        $is_login_data_inserted = $insert_publication_data->execute();

        echo $insert_publication_data->debugDumpParams();
        if ($is_login_data_inserted) {
            echo 'Dodano do bazy!';
        } else {
            echo 'Nie udało się dodać do bazy danch!';
        }

        $pdo = null;
        header('Location: publications-gridphp');
        exit();
    }
}

function is_smth_empty($checked_data)
{
    // add $user_email_err etc;
    $checked = "";
    if (empty(trim($_POST[$checked_data]))) {
        $checked = 'Please enter' . '$checked_data';
    } else {
        $checked = trim($_POST[$checked_data]);
    }
    return ($checked);
}

function handle_directory($user_email)
{
    $user_id =  $_SESSION["user_id"];
    $file_date = date("Y-m-d_(h-i)");
    if (!file_exists("users/" . $user_id . "/publications/" . $file_date . "/")) {
        @mkdir("users");
        @mkdir("users/" . $user_id);
        @mkdir("users/" . $user_id . "/publications/");
        @mkdir("users/" . $user_id . "/publications/" . $file_date);
    }
    $target_dir = "users/" . $user_id . "/publications/" . $file_date . "/";
    return $target_dir;
}

function handle_file($file_type, $user_email)
{
    $target_dir = handle_directory($user_email);
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
        echo "Przepraszam, plik o tej nazwie już ustnieje.";
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


//End of if($_SERVER["REQUEST_METHOD"] == "POST"){
//}
header('Location: publications-grid.php');
exit;
