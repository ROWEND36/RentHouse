<?php
/*
PUT
    title: string
    message: string
*/
require "paths.php";
require $PRIVATE."lib/signup.php";
require "./api_response.php";
apiCall("signup");
?>