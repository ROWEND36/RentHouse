<?php
require_once("errors.php");
function validateString($str, $name)
{
    static $regex = "/^[\w][\w\-]*$/";
    if (!preg_match($regex, $str)) {
        throw new APIError("Bad Parameter Value for ".$name,APIError::$BAD_PARAMETER);
    }
}
function validateRequest($keys,$REQUEST)
{
    if(!isset($REQUEST)){
        $REQUEST = $_POST;
    }
    foreach ($keys as $key) {
        if (!array_key_exists($key,$REQUEST)) {
            throw new APIError("Missing Parameter ".$key,APIError::$BAD_PARAMETER);
        }
    }
}
function validateLoggedIn($operation){
    if (!isset($_SESSION["DATA"])){
        throw new APIError("Unathorised user for operation ".$operation,APIError::$UNAUTHORISED);
    }
}
function array_safe_get($array,$key){
    if(array_key_exists($key,$array)){
        return $array[$key];
    }
    return FALSE;
}
?>