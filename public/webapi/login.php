<?php
/*
PUT
    title: string
    message: string
*/
require "paths.php";
require $PRIVATE."lib/login.php";
require "./api_response.php";
apiCall("login");
?>