<?php
/*
 * Used by microservices
 */
require_once "paths.php";
require_once $PRIVATE . "errors.php";
function apiCall($api)
{
    $result = null;
    try {
        $result = $api();
    } catch (APIError $error) {
        $error->die();
    } catch (Exception $e) {
        (new APIError($e->message, $e->$code, $e))->die();
    }
    if ($result) {
        $result = json_encode($result);
    }
    echo $result;
}
?>