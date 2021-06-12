<?php
require_once "paths.php";
require_once $PRIVATE . "connection.php";
require_once $PRIVATE . "lib/user.php";
function listAll($type=null)
{
    validateLoggedIn("list");
    if(!$type){
        validateRequest(["type"],$_GET);
        $type = $_GET["type"];
    }
    validateString($type, "type");

    $query = getDb()->prepare("SELECT * from datatables where type=?");
    $result = "";
    if ($query) {
        $query->bind_param("s", $type);
        if ($query->execute()) {
            $result = $query->get_result();
        }
    }
    if (!$result) {
        throw new APIError(getDb()->error, APIError::$DATABASE_ERROR);
    } elseif ($result->num_rows > 0) {
        $data = [];
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $item = ["id" => $row["_id"], "raw" => $row["DATA"]];
            array_push($data, $item);
        }
        return $data;
    } else {
        return [];
    }
}
?>