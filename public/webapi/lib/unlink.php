<?php
require "../../../private/validate.php";
require_once("../../../private/connection.php");
function unlink()
{
    validateLoggedIn("unlink");
    validateRequest(["type", "id"]);
    $type = $_GET["type"];
    validateString($type, "type");
    $id = $_GET["id"];
    validateString($id, "id");
    $query = $conn->prepare("DELETE from datatables where type=? and _id=?");
    $result = "";
    if ($query) {
        $query->bind_param("ss", $type, $id);
        if ($query->execute()) {
            $result = $query->get_result();
        }
    }
    if (!$result) {
        throw new APIError("Query Failed", APIError::$DATABASE_ERROR);
    }
}
?>