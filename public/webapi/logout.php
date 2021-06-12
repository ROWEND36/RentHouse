<?php
/*
PUT
    title: string
    message: string
*/
require "paths.php";
require $PRIVATE."lib/logout.php";
require "./api_response.php";
apiCall("logout");
?>