<?php
    session_start();
    $error = NULL;
    $logged_in = $_SESSION['DATA'];
    if(!$logged_in && array_key_exists("email",$_POST)){
        require("../webapi/lib/login.php");
        try{
            login();
            $logged_in = $_SESSION['DATA'];
        }
        catch(APIError $e){
            $error = $e;
        }
    }
    if($logged_in){
        include("views/view.php");
    }
    else{
        include ("views/login.php");
    }
?>