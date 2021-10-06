<?php
//if($_SERVER["REQUEST_METHOD"] == "POST"){

 $date = date ("Y-m-d");
@session_start();
  // Ttakeing user date ------------------------------------------------
    if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']== true))
    {
        $username=$_SESSION["username"];
        echo $username;
        $userID=$_SESSION["id"];
       
    }else{
         $userID=0;
         $randomNumber = rand(100,99999); 
         $username="AnonymusPublication".$date."-".$randomNumber;
        echo $username;
     }        
// End of takeing user date ------------------------------------------------


sednFileToServer("uploadJPG","uploadPDF",$username, $userID);
/* header('Location: solutions.php');
exit;  */


function sednFileToServer($JPGfile, $PDFfile, $username, $userID){
    echo"sending";
    $JPGsrc = handleFile($JPGfile, $username);
    $PDFsrc = handleFile($PDFfile, $username);
    $src=handleDirectory($username);
    
    
    //Testowe logi 
     echo "<br><b>".date ("Y-m-d (h-i)")."</b><br>";
    echo "<br>".$JPGsrc;
    echo  "<br>".$PDFsrc;        
    releaseSQL($JPGsrc, $PDFsrc, $username, $userID, $src);
} 

function releaseSQL($JPGsrc, $PDFsrc, $username, $userID, $src){
    require "connect.php";
    $date = date ("Y-m-d");  
    echo "starting sql insert...";
// Define variables and initialize with empty values 
        $Src=$src;
        $Title=strip_tags(trim($_POST["Title"]));
        $Localization=strip_tags(trim($_POST["Localization"]));
        $Tags=strip_tags(trim($_POST["Tags"]));        
        $category=strip_tags(trim($_POST["Category"]));     
        $retailBranch=strip_tags(trim($_POST["retailBranch"]));
        $abstract=strip_tags(trim($_POST["abstract"]));
        $description=strip_tags(trim($_POST["description"]));
        $autor=strip_tags(trim($_POST["qutor"]));
        $supervisor=strip_tags(trim($_POST["supervisor"]));
        $isPublic=strip_tags(trim($_POST["isPublic"]));
        $agree=strip_tags(trim($_POST["agree"]));    
    if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']== true))
        {
            $autor=$username;
        }
    
    echo "</br>data coverd";
        $required = array('Title', 'Tags', 'Category','retailBranch',
                         'description', 'agree' );

        // Loop over field names, make sure each one exists and is not empty
        $error = false;
        foreach($required as $field) {
            
          if (empty(strip_tags(trim(($_POST[$field]))))) {
            $error = true;
            echo "<br>brakuje -> ".$_POST[$field]."albo".$field." <-<br>";
          }else{
              echo "Jest -".$field."<br>";
          }
        }

        if ($error) {
          echo "</br>Uzupełnij dane!";
        } else {
            echo"</br>Lounch sql...";
        // Prepare a select statement
        //$sql = "INSERT INTO `publications`( `authorID`,`date`,`IMGsrc`, `title`, `category`, `retailBranch`, `PDFsrc`, `description`) VALUES ('$userID', '$date','$JPGsrc','$Title','$Tags','$Category','$PDFsrc','$TextArea');";
            
        $sqlUploadPublication="INSERT INTO `publications`( `isPublic`,`authorID`, `autornIFnotlLogIn`,`supervisor`, `date`,`IMGsrc`, `title`, `category`, `retailBranch`, `PDFsrc`, `src`, `description`, `abstract`) 
                                                    VALUES (:isPublic ,:userID, :autornIFnotlLogIn, :supervisor, :date, :JPGsrc, :Title, :category, :retailBranch, :PDFsrc, :src, :description, :abstract);";
            
        $InsertPublicationData= $pdo->prepare($sqlUploadPublication);
        $InsertPublicationData->bindValue('isPublic', $isPublic, PDO::PARAM_INT);        
        $InsertPublicationData->bindValue('userID', $userID, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('autornIFnotlLogIn', $autor, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('supervisor', $supervisor, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('date', $date, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('JPGsrc', $JPGsrc, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('Title', $Title, PDO::PARAM_STR);        
        $InsertPublicationData->bindValue('category', $category, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('retailBranch', $retailBranch, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('PDFsrc', $PDFsrc, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('src', $Src, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('description', $description, PDO::PARAM_STR);        
        //$InsertPublicationData->bindValue('Tags', $Tags, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('abstract', $abstract, PDO::PARAM_STR);
        $isLoginDataInserd = $InsertPublicationData->execute();
             echo "</br>end";
        echo $InsertPublicationData->debugDumpParams();
            
        if ($isLoginDataInserd) {
            echo '</br>Dodano do bazy!';
        } else {
            echo '</br>Nie udało się dodać do bazy danch!';
        }
            echo "</br>po sql";
        // Close statement
         mysqli_stmt_close($stmt);
         // Close connection
        mysqli_close($polaczenie);
            header('Location: solutions.php');
	exit();
    }
   
}

function isSmthEmpty($dataToCheck){
    // add $username_err etc;
    $chcecked="";
     if(empty(trim($_POST[$dataToCheck])))
     {
        $chcecked = 'Please enter"."$dataToCheck".';
     } else{
        $chcecked = trim($_POST[$dataToCheck]);
     }    
    return($chcecked);
}

function handleDirectory($username){    
     $FileDate = date ("Y-m-d_(h-i)");
      if (!file_exists("UsersFoldres/".$username."/publication/". $FileDate."/"))
    {
        
    @mkdir("UsersFoldres/".$username);
    @mkdir("UsersFoldres/".$username."/publication/");
    @mkdir("UsersFoldres/".$username."/publication/".$FileDate);
    } 
    $target_dir = "UsersFoldres/".$username."/publication/".$FileDate."/";   
    return $target_dir;
}

function handleFile($fileType, $username){
    $target_dir = handleDirectory($username);    
    $target_file = $target_dir . basename($_FILES[$fileType]["name"]);
    $uploadCheck = 0; 
 
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    echo "<br>";
    echo $imageFileType." <= typ<br>";
    echo $_FILES[$fileType]["name"]."<br>";
    echo $_FILES[$fileType]["tmp_name"]."<br>";
    echo $_FILES[$fileType]["size"]."<br>";

    // Check if image file is a actual image or fake image   
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Przepraszam, plik o tej nazwie już ustnieje.";
        $uploadCheck = 1;
    }
    // Check file size
    if ($_FILES[$fileType]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadCheck = 1;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
        echo "Sorry, only JPG, JPEG, PDF files are allowed.";
        $uploadCheck = 1;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadCheck == 1) {
        echo "<br>Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$fileType]["tmp_name"], $target_file)) {
            echo "<br>The file ". basename( $_FILES[$fileType]["name"]). " has been uploaded.";
        } else {
            echo "<br>Sorry, there was an error uploading your file.";
        }
    }
    if($imageFileType=="pdf"){
    PDFtoJPGgenerate($target_file,$target_dir);
    }
    return $target_file;
}
function PDFtoJPGgenerate($PDFsrc,$target_dir){
    try {
        $im = new Imagick();
       $resolution = 300; 
       $im->setResolution($resolution,$resolution);
   
       $im->readimage($PDFsrc.'[0]'); 
       $im->setImageFormat('jpeg');       
       $im->writeImage($target_dir.'/pageone.jpg'); 
       $im->clear(); 
       $im->destroy(); 
   
       $im->readimage($PDFsrc.'[1]'); 
       $im->setImageFormat('jpeg');       
       $im->writeImage($target_dir.'/pagetwo.jpg'); 
       $im->clear(); 
       $im->destroy(); 
    } catch (ImagickException $e){
            var_dump($e);            
    }  

echo"JPG generated.<br>";
}


//End of if($_SERVER["REQUEST_METHOD"] == "POST"){
//}
 header('Location: solutions.php');
exit;




?>
