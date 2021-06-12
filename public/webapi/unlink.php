<?php
/*
PUT
    title: string
    message: string
*/
require "paths.php";
require $PRIVATE."lib/unlink.php";
require "./api_response.php";
apiCall("unlinkListItem");
?>