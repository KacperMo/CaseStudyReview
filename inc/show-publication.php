<?php
//getSolutions();
//@header("location: solutions.php");
select_only();
function select_only($what = "category")
{
    require "inc/connect.php";
    $sql = "select DISTINCT category from publications;";
    $only_one = $pdo->prepare($sql);
    //$only_one->bindParam(':what',$what);    
    $result = $only_one->execute();
    $only_one->bindColumn(1, $column);

    $list_of = array();
    while ($row = $only_one->fetch(PDO::FETCH_BOUND)) {
        $tmp = array();
        $tmp["item"] = $column;
        array_push($list_of, $tmp);
    }
    //$stmt->close();
    //echo("Znaleziono ".$only_one->rowCount());
    //print_r($list_of);

    return $list_of;
}

/*
function get_author_date($user_id)
{
    require_once "inc/connect.php";
    // ZROBIĆ BINDOWANIE 
    $author_detail = "SELECT * FROM `users` WHERE `userID`=$user_id";
    $get_author_detail = $pdo->prepare($author_detail);
    $execute_author_detail = $get_author_detail->execute();
    return 0;
}
*/


function get_solutions($publication_limit_on_page = 9, $offset = 1)
{
    require "inc/connect.php";

    //ilość wszystkich publikacji
    $count_all_publications = "SELECT count(`publicationID`) as count FROM publications;";
    $how_many_publications = $pdo->prepare($count_all_publications);
    $execute_how_many_publications = $how_many_publications->execute();
    $publications_count = $how_many_publications->fetchAll();
    $publications_count = $publications_count[0]['count'];

    //ilość wszystkich publikacji
    //echo $publications_count;

    //Prepare a select statement  
    $sql_get_solutions = prepare_sql_query();
    $stmt = $pdo->prepare($sql_get_solutions);
    /*   
        if($stmt){
            ///echo("prepare <br>");
        }else{
            //echo("error <br>");
        } */
    //$stmt->bindValue('publicationID', $_GET['publicationID'], PDO::PARAM_INT); 
    if (isset($_GET['publicationID'])) {
        //echo("publicationID: ".$_GET['publicationID']);
        $stmt->bindValue('publicationID', $_GET['publicationID'], PDO::PARAM_INT);
    }
    if (isset($_GET['category'])) {
        //echo("category: ".$_GET['category']);
        $stmt->bindParam('category', ($_GET['category']), PDO::PARAM_STR);
    }
    if (isset($_GET['Page'])) {
        $stmt->bindValue('offset', (int) trim(($_GET['Page'] - 1) * 5), PDO::PARAM_INT);
    } else {
        $stmt->bindValue('offset', (($offset - 1) * 5), PDO::PARAM_INT);
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
    if ($result) {
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

        $publication_data = array();

        while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
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

            array_push($publication_data, $tmp);
        }
        //$stmt->close();

        //echo("<br>Znaleziono ".$publications_count);
    } else {
        echo ("błąd wykonania");
    }
    if ($stmt->rowCount() < 1) {
        echo ("Brak wyników");
    }
    $count = $stmt->rowCount();
    //print("Found $count rows.\n");
    //print_r($publication_data);
    //echo($publication_data)."ee";
    //echo("ee");
    @$stmt->rowCount = $publications_count;
    @$stmt->publication_data = $publication_data;
    //@$stmt->countPublication =$publications_count;
    //print_r($object);

    return $stmt;
}

/* function rightPanel(){
    
} */


//this function get data from url 
function prepare_sql_query()
{
    $page = 1;
    $query = "SELECT * FROM publications ";
    $search_param = "";
    $search_param = " WHERE 1=1";
    if ($_GET) {
        //do something if $_GET is set 
        if (isset($_GET['publicationID'])) {
            $search_param .= " AND publicationID = :publicationID";
        }
        if (isset($_GET['category'])) {
            $search_param .= " AND category = :category";
        }
        /* foreach($_GET as $key => $value){
                        $search_param .= ' OR '.$key.' like '.$value;
                } */
    }
    $search_param .= ' ORDER BY publicationID DESC';
    $search_param .= " LIMIT :offset, :limit;";
    $query .= $search_param;
    //echo("Query-> ".$query."<br>");
    return $query;
}
