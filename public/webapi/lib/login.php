<?php
/*
POST
    email: email
    password: password
*/
require_once "../../../private/connection.php";
require "../../../private/validate.php";
function login()
{
    validateRequest(["email", "password"]);
    if (isset($_SESSION["DATA"])) {
        throw new APIError("Already Logged In", APIError::$API_ERROR);
    }
    $query = $conn->prepare("SELECT * FROM users WHERE email=?");
    $result = "";
    if ($query) {
        $user = strtolower($_POST["email"]);
        $query->bind_param("s", $user);
        if ($query->execute()) {
            $result = $query->get_result();
        }
    }
    if (!$result) {
        throw new APIError("Query Failed", APIError::$DATABASE_ERROR);
    }
    if ($result->num_rows > 1) {
        $data = $result->fetch_assoc();
        if (password_verify($_POST["password"], $data["password"])) {
            session_start();
            $_SESSION["DATA"] = $result->fetch_assoc();
            return;
        }
    }
    //Give the same message regardless of whether
    //user does not exist or password is wrong
    throw new APIError(
        "Bad Parameter Value for " . $name,
        APIError::$BAD_PARAMETER
    );
}
?>