<?php
//Helper Api when you don't want to use AJAX
require "paths.php";
require_once $PRIVATE . "validate.php";
date_default_timezone_set("Africa/Lagos");
$redirect = array_safe_get($_GET, "redirect");
if (!$redirect) {
    $redirect = "/";
}
$data = ["time" => date("D d/m/Y h:ia")];
foreach ($_POST as $name => $value) {
    if ($name != "type") {
        $data[$name] = $value;
    }
}
$_POST["data"] = json_encode($data);
require $PRIVATE . "lib/submit.php";
try {
    submit();
} catch (Exception $e) {
    error_log($e);
    //completely ignore any exceptions unfortunately
    //To handle them, use the javascript API
}
header("Location: " . $redirect, true, 307);
?>