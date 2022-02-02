<?php
require_once "inc/connect.php";

function select_only($what = "category")
{
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
    // ZROBIĆ BINDOWANIE 
    $author_detail = "SELECT * FROM `users` WHERE `userID`=$user_id";
    $get_author_detail = $pdo->prepare($author_detail);
    $execute_author_detail = $get_author_detail->execute();
    return 0;
}
*/


function get_publications($db)
{
    /* Return all publications. */
    $query = mysqli_prepare($db, "SELECT * FROM publications");
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    $publications = $result ? mysqli_fetch_assoc($result) : 0;
    return $publications;
}

/* function rightPanel(){
    
} */
