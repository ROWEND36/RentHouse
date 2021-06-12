<?php

// Create connection
function getDb()
{
    static $conn = null;
    if($conn==null){
        require "paths.php";
        require $PRIVATE . "password.php";
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    }
    // Check connection
    if ($conn->connect_error) {
        error_log(
            "Failed connection for $db_username: " +
                $db_username .
                " $db_password: " .
                $db_password .
                " servername: " .
                servername .
                " dbname: " .
                dbname
        );
        throw new APIError($conn->connect_error,APIError::$DATABASE_ERROR);
    }
    return $conn;
}
?>