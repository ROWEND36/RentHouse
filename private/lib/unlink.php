<?php
require_once "paths.php";
require_once $PRIVATE . "connection.php";
require_once $PRIVATE . "lib/user.php";
function unlinkListItem()
{
    validateLoggedIn("unlink");
    validateRequest(["type", "id"],$_GET);
    $type = $_GET["type"];
    validateString($type, "type");
    $id = $_GET["id"];
    validateString($id, "id");
    $query = getDb()->prepare("DELETE from datatables where TYPE=? and _id=?");
    $result = "";
    if ($query) {
        $query->bind_param("ss", $type, $id);
        if ($query->execute()) {
            return 'Success';
        }
        else throw new APIError($query->error, APIError::$DATABASE_ERROR);
    }
    else throw new APIError(getDb()->error, APIError::$DATABASE_ERROR);
    
}
?>