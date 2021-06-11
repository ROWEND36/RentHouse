<?php
require "../../../private/connection.php";
require "../../../private/validate.php";
function listAll()
{
    validateLoggedIn("list");
    validateRequest(["type"]);
    $type = $_GET["type"];
    validateString($type, "type");

    $query = $conn->prepare("SELECT * from datatables where type=?");
    $result = "";
    if ($query) {
        $query->bind_param("s", $type);
        if ($query->execute()) {
            $result = $query->get_result();
        }
    }
    if (!$result) {
        throw new APIError("Select failed",APIError::$DATABASE_ERROR);
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