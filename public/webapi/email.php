<?php
/*
PUT
    title: string
    message: string
*/
require "paths.php";
require $PRIVATE."lib/email.php";
require "./api_response.php";
apiCall("email");
?>