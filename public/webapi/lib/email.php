<?php
/*
PUT
    title: string
    message: string
*/
require "../../../private/mailer.php";
require_once "../../../private/validate.php";
function email()
{
    $title = $_POST["title"];
    validateRequest(["message", "keys", "pass"]);
    $message = $_POST["message"];
    $pass = $_POST["passkey"];
    sendMail($title, $message, $pass);
}
?>