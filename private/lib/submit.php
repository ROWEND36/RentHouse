<?php
require_once "paths.php";
require_once($PRIVATE."connection.php");
require_once $PRIVATE."validate.php";
function submit()
{
    validateRequest(["type","data"]);
    $type = $_POST["type"];
    validateString($type, "type");

    $data = $_POST["data"];
    $conn = getDb();
    $query = $conn->prepare("INSERT into datatables (type,data) VALUES(?,?)");
    $result = false;
    if ($query) {
        $query->bind_param("ss", $type, $data);
        $conn->begin_transaction();
        $query->execute();
        $id = $conn->insert_id;
        $result = $conn->commit();
    }
    if (!$result) {
        throw new APIError(getDb()->error,APIError::$DATABASE_ERROR);
    } 
    return $id;
    
}
?>