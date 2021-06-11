<?php
require_once("../../../private/connection.php");
require "../../../private/validate.php";
function signup()
{
    validateRequest(["email","password","secret_key"]);
    $email = $_POST["email"];
    $password = $_POST["password"];
    $secret_key = $_POST["secret_key"];
    validateString($password, "password");
    validateString($email, "email");
    //No roles just one type of user
    if ($secret_key != $signup_api_key) {
        throw new APIError("Invalid passkey ",APIError::$INVALID_CREDENTIALS);
    }

    $query = $conn->prepare("INSERT into users (email,password) VALUES(?,?)");
    $result = false;
    if ($query) {
        $query->bind_param("ss", $email, $password);
        $conn->begin_transaction();
        $query->execute();
        $id = $conn->insert_id;
        $result = $conn->commit();
    }
    if (!$result) {
        throw new APIError("Insert Failed",APIError::$DATABASE_ERROR);
    }
}
?>