<?php
require_once "paths.php";
require_once $PRIVATE."validate.php";
session_start();
function user()
{
    return array_safe_get($_SESSION,"DATA");
}
?>