<?php
/*
POST
    email: email
    password: password
*/
require_once "paths.php";
require_once $PRIVATE . "connection.php";
require_once $PRIVATE . "validate.php";
require_once $PRIVATE . "lib/user.php";
function login()
{
    validateRequest(["email", "password"]);
    validateEmail($_POST["email"], "email");
    if (user()) {
        throw new APIError("Already Logged In", APIError::$API_ERROR);
    }
    $query = getDb()->prepare("SELECT * FROM users WHERE email=?");
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
    else if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        if (password_verify($_POST["password"], $data["password"])) {
            $_SESSION["DATA"] = true; //to do add more user data
            return;
        }
    }
    //Give the same message regardless of whether
    //user does not exist or password is wrong
    throw new APIError(
        "Wrong username or password",
        APIError::$INVALID_CREDENTIALS
    );
}
?>