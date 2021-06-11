<?php
if (!isset($_SESSION["DATA"])) {
    header("Unauthorized", true, 405);
    die("User is not logged in");
}
?>