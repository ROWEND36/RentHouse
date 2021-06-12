<?php
/*
PUT
    type: string
*/
require "paths.php";
require $PRIVATE."lib/list.php";
require "./api_response.php";
apiCall("listAll");
?>