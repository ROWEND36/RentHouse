<?php
function logout()
{
    session_start();
    $_SESSION["DATA"] = null;
    session_destroy();
}
?>