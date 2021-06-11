<?php

require("password.php");

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    header($_SERVER['SERVER_PROTOCOL'] . ' Database Connection failed', true, 500);
    error_log("Failed connection for $username: "+$username." $password: ".$password." servername: ".servername." dbname: ".dbname);
    die("Connection failed: " . $conn->connect_error);
}

?>