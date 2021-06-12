<?php
require_once "paths.php";
require_once $PRIVATE . "errors.php";
function validateString($str, $name)
{
    static $regex = "/^[\w][\w\-]*$/";
    if (!preg_match($regex, $str)) {
        throw new APIError(
            "Bad Parameter Value for " . $name,
            APIError::$BAD_PARAMETER
        );
    }
}
function validateEmail($email, $name)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))  {
        throw new APIError(
            "Bad Parameter Value for " . $name,
            APIError::$BAD_PARAMETER
        );
    }
}
function validateRequest($keys, $REQUEST = null)
{
    if (!isset($REQUEST)) {
        $REQUEST = $_POST;
    }
    foreach ($keys as $key) {
        if (!array_key_exists($key, $REQUEST)) {
            throw new APIError(
                "Missing Parameter " . $key,
                APIError::$BAD_PARAMETER
            );
        }
    }
}
function validateLoggedIn($operation="operation")
{
    if (!array_safe_get($_SESSION, "DATA")) {
        throw new APIError(
            "Unathorised user for operation " . $operation,
            APIError::$UNAUTHORISED
        );
    }
}
function array_safe_get($array, $key)
{
    if (array_key_exists($key, $array)) {
        return $array[$key];
    }
    return false;
}
?>