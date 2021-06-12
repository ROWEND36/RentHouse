<?php
function logout()
{
    $_SESSION["DATA"] = null;
    session_destroy();
}
?>