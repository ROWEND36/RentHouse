<?php
/*
POST
    oldpass: oldpass *unused*
    newpass: newpass
*/

require "../../private/connection.php";
require "logged_in.php";
if (isset($_SESSION["DATA"])) {
    header("Already Logged In", true, 403);
    die();
}
$result = $conn->prepare("UPDATE users SET password=? WHERE email=?");
$result = "";
if ($query) {
    $newpass = password_hash($_POST["password"]);
    $user = $_SESSION["email"];
    $query->bind_param("ss", $newpass,$user);
    if ($query->execute()) {
        //Todo check $query->$affected_rows;
    }
    else{
        header("Internal Server Error",403);
        die();
    }
}
?>