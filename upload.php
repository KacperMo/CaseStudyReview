<?php
//if($_SERVER["REQUEST_METHOD"] == "POST"){

 $date = date ("Y-m-d");
@session_start();
  // Ttakeing user date ------------------------------------------------
    if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']== true))
    {
        $userEmail=$_SESSION["userEmail"];
        echo $userEmail;
        $userID=$_SESSION["idOfUser"];
       
    }else{
         $userID=0;
         $randomNumber = rand(100,99999); 
         $userEmail="AnonymusPublication".$randomNumber."@".$date."-"."CaseStudy";
        echo $userEmail;
     }        
// End of takeing user date ------------------------------------------------


sednFileToServer("uploadJPG","uploadPDF",$userEmail, $userID);
/* header('Location: solutions.php');
exit;  */


function sednFileToServer($JPGfile, $PDFfile, $userEmail, $userID){
    //$FileDate = date ("Y-m-d_(h-i)");
    $JPGsrc = handleFile($JPGfile, $userEmail);
    $PDFsrc = handleFile($PDFfile, $userEmail);
    $src=handleDirectory($userEmail);
    
    
    //Testowe logi 
 /*    echo "<br><b>".date ("Y-m-d (h-i)")."</b><br>";
    echo "<br> jpgsrc ======> ".$JPGsrc;
    echo  "<br>PDFsrc ======> ".$PDFsrc;    
    echo  "<br>src ======> ".$src."-------------------------------------------------------";     */
    releaseSQL($JPGsrc, $PDFsrc, $userEmail, $userID, $src);
} 

function releaseSQL($JPGsrc, $PDFsrc, $userEmail, $userID, $src){
    require "connect.php";
    $date = date ("Y-m-d");  
    
// Define variables and initialize with empty values 
        $Src=$src;
        $Title=strip_tags(trim($_POST["Title"]));
        //$Localization=strip_tags(trim($_POST["Localization"]));
        $Tags=strip_tags(trim($_POST["Tags"]));        
        $abstract=strip_tags(trim($_POST["abstract"]));
        $category=strip_tags(trim($_POST["Category"]));     
        //$retailBranch=strip_tags(trim($_POST["retailBranch"]));        
        $description=strip_tags(trim($_POST["description"]));
        @$autor=strip_tags(trim($_POST["autor"]));
            //dodać regółe jeżeli pole puste to autor z sesji


        //$supervisor=strip_tags(trim($_POST["supervisor"]));
        $isPublic=strip_tags(trim($_POST["isPublic"]));
        //$agree=strip_tags(trim($_POST["agree"]));


        if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']== true))
        {
            $autor=$userEmail;
        }
        echo "User ID:".$userID."<br>";
    
        $required = array('Title', 'Tags', 'Category',
                         'description');
        
        
        // Loop over field names, make sure each one exists and is not empty
        $error = false;
        foreach($required as $field) {
            
          if (empty(strip_tags(trim(($_POST[$field]))))) {
            $error = true;
            //echo "<br>brakuje -> ".$_POST[$field]."albo".$field." <-<br>";
          }else{
              //echo "Jest -".$field."<br>";
          }
        }

        if ($error) {
          echo "Uzupełnij dane!";
        } else {
            echo"dodaje";
        // Prepare a select statement
        //$sql = "INSERT INTO `publications`( `authorID`,`date`,`IMGsrc`, `title`, `category`, `retailBranch`, `PDFsrc`, `description`) VALUES ('$userID', '$date','$JPGsrc','$Title','$Tags','$Category','$PDFsrc','$TextArea');";
            
           
        $sqlUploadPublication="INSERT INTO `publications`( `isPublic`,`authorID`, `autornIFnotlLogIn`, `date`,`IMGsrc`, `title`, `category`, `PDFsrc`, `src`, `description`, `abstract`) 
                                                    VALUES (:isPublic ,:userID, :autornIFnotlLogIn, :date, :JPGsrc, :Title, :category, :PDFsrc, :src, :description, :abstract);";
            
        $InsertPublicationData= $pdo->prepare($sqlUploadPublication);        
                echo "isPublic: ".$isPublic."<br>";  
        $InsertPublicationData->bindValue('isPublic', $isPublic, PDO::PARAM_INT);      
        $InsertPublicationData->bindValue('userID', $userID, PDO::PARAM_STR);
                echo "autor: ".$autor."<br>";
        $InsertPublicationData->bindValue('autornIFnotlLogIn', $autor, PDO::PARAM_STR);
        //$InsertPublicationData->bindValue('supervisor', $supervisor, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('date', $date, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('JPGsrc', $JPGsrc, PDO::PARAM_STR);
                echo "Title: ".$Title."<br>";
        $InsertPublicationData->bindValue('Title', $Title, PDO::PARAM_STR);
                echo "category: ".$category."<br>";        
        $InsertPublicationData->bindValue('category', $category, PDO::PARAM_STR);
        //$InsertPublicationData->bindValue('retailBranch', $retailBranch, PDO::PARAM_STR);
        $InsertPublicationData->bindValue('PDFsrc', $PDFsrc, PDO::PARAM_STR);
                echo "Src: ".$Src."<br>";
        $InsertPublicationData->bindValue('src', $Src, PDO::PARAM_STR);  
        echo "description: ".$description."<br>";                  
        $InsertPublicationData->bindValue('description', $description, PDO::PARAM_STR);
                echo "Tags: ".$Tags."<br>";                    
        //$InsertPublicationData->bindValue('Tags', $Tags, PDO::PARAM_STR);    
                echo "Streszczenie: ".$abstract."<br>";            
        $InsertPublicationData->bindValue('abstract', $abstract, PDO::PARAM_STR);
        $isLoginDataInserd = $InsertPublicationData->execute();
                echo "</br>executed";

        echo $InsertPublicationData->debugDumpParams();
        if ($isLoginDataInserd) {
            echo 'Dodano do bazy!';
        } else {
            echo 'Nie udało się dodać do bazy danch!';
        }

        $pdo=null;
        header('Location: publications-grid.php.php');
	    exit();
    }
   
}

function isSmthEmpty($dataToCheck){
    // add $userEmail_err etc;
    $chcecked="";
     if(empty(trim($_POST[$dataToCheck])))
     {
        $chcecked = 'Please enter"."$dataToCheck".';
     } else{
        $chcecked = trim($_POST[$dataToCheck]);
     }    
    return($chcecked);
}

function handleDirectory($userEmail){    
     $FileDate = date ("Y-m-d_(h-i)");
      if (!file_exists("UsersFoldres/".$userEmail."/publication/". $FileDate."/"))
    {
    @mkdir("UsersFoldres");
    @mkdir("UsersFoldres/".$userEmail);
    @mkdir("UsersFoldres/".$userEmail."/publications/");
    @mkdir("UsersFoldres/".$userEmail."/publications/".$FileDate);
    } 
    $target_dir = "UsersFoldres/".$userEmail."/publications/".$FileDate."/";   
    return $target_dir;
}

function handleFile($fileType, $userEmail){
    $target_dir = handleDirectory($userEmail);    
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
    if ($_FILES[$fileType]["size"] > 500000) {
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
    /* try {
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
    }  */ 

    
echo"JPG generated.<br>";
}


//End of if($_SERVER["REQUEST_METHOD"] == "POST"){
//}
 header('Location: publications-grid.php');
exit; 




?>
