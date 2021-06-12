<?php
/*
PUT
    title: string
    message: string
*/
require_once "paths.php";
require_once $PRIVATE."mailer.php";
require_once $PRIVATE."validate.php";
function email()
{
    validateRequest(["title","message", "passkey"]);
    $title = $_POST["title"];
    $message = $_POST["message"];
    $pass = $_POST["passkey"];
    $error = sendMail($title, $message, $pass);
    if($error){
        throw new APIError($error,APIError::$SERVER_ERROR);
    }
}
?>