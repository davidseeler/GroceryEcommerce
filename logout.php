<?php
    session_start();
    $_SESSION["username"] = NULL;
    $_SESSION["password"] = NULL;
    header("Location: signin.php");
?>