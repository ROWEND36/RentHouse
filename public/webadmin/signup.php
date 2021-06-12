<?php
require_once "paths.php";
require_once $PRIVATE . "/lib/user.php";
$logged_in = user();

if (array_key_exists("email", $_POST)) {
    require_once $PRIVATE . "/lib/signup.php";
    try {
        signup();
    } catch (APIError $e) {
        $signup_error = $e;
    }
}
if(isset($signup_error)){
    $signup_mode = true;
}
include "./views/login.php";
?>