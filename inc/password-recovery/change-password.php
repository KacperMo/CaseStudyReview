<?php

if(isset($_POST['password-submit'])){
    $token = $_GET['token'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if($password1==$password2){
        header('location: password-change.php?token='.$token);
    }

    else{
        header('location: password-change.php?token='.$token.'&error=001');
    }
}
?>