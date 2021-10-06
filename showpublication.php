<?php
 
//TakeSolutions();
//@header("location: solutions.php");
selectOny();
function selectOny($what="category"){
    require "connect.php";
    $sql="select DISTINCT category from publications;";    
    $onlyone = $pdo->prepare($sql);     
    $onlyone->bindParam(':what',$what);    
    $result = $onlyone->execute();
    $onlyone->bindColumn(1, $column);

    $listOf=array();
    while($row = $onlyone->fetch(PDO::FETCH_BOUND)) {
        $tmp = array();
        $tmp["item"] = $column;
        array_push($listOf, $tmp);
    }
    //$stmt->close();
    //echo("Znaleziono ".$onlyone->rowCount());
    //print_r($listOf);

    return $listOf;
}

function takeAuthorDate($authorID){
    require_once "connect.php";

    // ZROBIĆ BINDOWANIE 
    $AuthorDetail="SELECT * FROM `users` WHERE `userID`=$authorID";


    $takeAuthorDetail=$pdo->prepare($AuthorDetail);
    $executeAuthorDetail=$takeAuthorDetail->execute();
return 0;
}


function takeSolutions($publicationLimitOnPage=9, $offset=1){
    require "connect.php";       
        
        //ilość wszystkich publikacji
        $countAllPublication="SELECT count(`publicationID`) as count FROM publications;";
        $howManyPublication=$pdo->prepare($countAllPublication);        
        $ExecuteHowManyPublication = $howManyPublication->execute();
        $numOfPublications=$howManyPublication->fetchAll();
        $numOfPublications=$numOfPublications[0]['count'];
        
        //ilość wszystkich publikacji
        //echo $numOfPublications;
        
        //Prepare a select statement  
        $sqlTakeSolutions = prepareSQLquerry();
        $stmt = $pdo->prepare($sqlTakeSolutions);
         /*   
        if($stmt){
            ///echo("prepare <br>");
        }else{
            //echo("error <br>");
        } */
        //$stmt->bindValue('publicationID', $_GET['publicationID'], PDO::PARAM_INT); 
            if(isset($_GET['publicationID'])){
                //echo("publicationID: ".$_GET['publicationID']);
                $stmt->bindValue('publicationID', $_GET['publicationID'], PDO::PARAM_INT);                  
            } 
            if(isset($_GET['category'])){
                //echo("category: ".$_GET['category']);
                $stmt->bindParam('category', ($_GET['category']), PDO::PARAM_STR); 
            } 
            if(isset($_GET['Page'])){               
                $stmt->bindValue('offset', (int) trim(($_GET['Page'] - 1) * 5), PDO::PARAM_INT);  
            }else{
                $stmt->bindValue('offset',  (( $offset - 1) * 5), PDO::PARAM_INT);
            }
            $stmt->bindValue('limit', $publicationLimitOnPage, PDO::PARAM_INT); //jak duzo na stronie

            //echo "Offset ".(( $offset-1) * 5)." limit ".$publicationLimitOnPage."<br><br>";
            //$stmt->debugDumpParams();

            /* $stmt->bindValue('limit', 10); //jak duzo na stronie
            $stmt->bindValue('offset', ($_GET['Page'] - 1) * 10); */  
            //$stmt->bindValue('limit', 10); //jak duzo na stronie
            //$stmt->bindValue('offset', ($page - 1) * 10); 

            //echo("execute");
            // Attempt to execute the prepared statement
            $result = $stmt->execute();
            if($result){
                // Store result                                              
                 // Bind result variables
                //mysqli_stmt_bind_result($stmt, $publicationID, @isPublic, $authorID, $autornIFnotlLogIn, $supervisor, $date ,$IMGsrc ,$title ,$category, $views ,$retailBranch ,$PDFsrc ,$description, $stars);
               
                $stmt->bindColumn(1, $publicationID);
                $stmt->bindColumn(2, $isPublic);
                $stmt->bindColumn(3, $authorID);
                $stmt->bindColumn(4, $autornIFnotlLogIn);
                $stmt->bindColumn(5, $supervisor);
                $stmt->bindColumn(6, $date);
                $stmt->bindColumn(7, $IMGsrc);
                $stmt->bindColumn(8, $title);
                $stmt->bindColumn(9, $category);
                $stmt->bindColumn(10, $views);
                $stmt->bindColumn(11, $retailBranch);
                $stmt->bindColumn(12, $PDFsrc);
                $stmt->bindColumn(13, $src);
                $stmt->bindColumn(14, $description);
                $stmt->bindColumn(15, $abstract);                  
                $stmt->bindColumn(16, $stars);
               
                $publicationData = array();

                while($row = $stmt->fetch(PDO::FETCH_BOUND)) {
                    $tmp = array();
                    $tmp["publicationID"] = $publicationID;
                    $tmp["authorID"] = $authorID;
                    $tmp["autornIFnotlLogIn"] = $autornIFnotlLogIn;
                    $tmp["supervisor"] = $supervisor;
                    $tmp["date"] = $date;
                    $tmp["IMGsrc"] = $IMGsrc;
                    $tmp["title"] = $title;
                    $tmp["category"] = $category;
                    $tmp["views"] = $views;
                    $tmp["retailBranch"] = $retailBranch;
                    $tmp["PDFsrc"] = $PDFsrc;
                    $tmp["src"] = $src;
                    $tmp["description"] = $description;
                    $tmp["abstract"] = $abstract;
                    $tmp["stars"] = $stars;                   

                    array_push($publicationData, $tmp);
                }
                //$stmt->close();

            //echo("<br>Znaleziono ".$numOfPublications);
        }else{
            echo("błąd wykonania");
        }
        if($stmt->rowCount()<1){
            echo("Brak wyników");
        }
        $count = $stmt->rowCount();
        //print("Found $count rows.\n");
        //print_r($publicationData);
        //echo($publicationData)."ee";
        //echo("ee");
        @$object->rowCount = $numOfPublications;
        @$object->publicationData = $publicationData;
        //@$object->countPublication =$numOfPublications;
        //print_r($object);

        return $object;
}

/* function rightPanel(){
    
} */


//this function get data from url 
 function prepareSQLquerry(){    
    $page=1;
     $query = "SELECT * FROM publications ";
     $searchParam="";
     $searchParam=" WHERE 1=1";
            if($_GET){
                //do something if $_GET is set 
                if(isset($_GET['publicationID'])){
                    $searchParam .=" AND publicationID = :publicationID";
                }
                if(isset($_GET['category'])){
                    $searchParam .=" AND category = :category";
                }                 
                /* foreach($_GET as $key => $value){
                        $searchParam .= ' OR '.$key.' like '.$value;
                } */     
            }

   
    $searchParam .=' ORDER BY publicationID DESC';
    $searchParam .=" LIMIT :offset, :limit;";
    $query .= $searchParam;             
    //echo("Query-> ".$query."<br>");
    return $query;
 }


?>