<?php
    require_once "../components/session.php";
    session_unset();
    session_destroy();
    header("Location:index.php");
    die();
?>