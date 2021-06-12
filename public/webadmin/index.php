<?php
require_once "paths.php";
require_once $PRIVATE."/lib/user.php";
$logged_in = user();

if ($logged_in) {
    include "views/view.php";
} else {
    header("Location: /webadmin/login.php",true,307);
}
?>