<?php
require_once "paths.php";
require_once($PRIVATE."connection.php");
require_once $PRIVATE."validate.php";
function signup()
{
    global $PRIVATE;
    validateRequest(["email","password","secret_key"]);
    include $PRIVATE . "password.php";
    $user_email = strtolower($_POST["email"]);
    validateEmail($user_email, "email");
    
    $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
    $secret_key = $_POST["secret_key"];
    //No roles just one type of user
    /*if ($secret_key != $signup_api_key) {
        throw new APIError("Invalid passkey ",APIError::$INVALID_CREDENTIALS);
    }*/

    $query = getDb()->prepare("INSERT into users (email,password) VALUES(?,?)");
    $result = false;
    if ($query) {
        $query->bind_param("ss", $user_email, $password);
        $result = $query->execute();
    }
    if (!$result) {
        throw new APIError(getDb()->error,APIError::$DATABASE_ERROR);
    }
}
?>