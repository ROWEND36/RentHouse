<?php
/*
* Used by microservices
*/
require_once("../../private/errors.php");
function apiCall($api){
    $result = NULL;
    try{
        $result = $api();
    }
    catch(APIError $error){
        $error->die();
    }
    catch(Exception $e){
        (new APIError($e->message,$e->$code,$e))->die();
    }
    return $result;
}
?>