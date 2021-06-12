<?php
require_once "paths.php";
require_once $PRIVATE . "/lib/user.php";
$logged_in = user();

if (array_key_exists("email", $_POST)) {
    require_once $PRIVATE . "/lib/login.php";
    try {
        login();
        $logged_in = user();
    } catch (APIError $e) {
        $login_error = $e;
    }
}
if ($logged_in) {
    header("Location: /webadmin/", true, 307);
} else {
    include "./views/login.php";
}
?>