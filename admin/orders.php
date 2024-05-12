<?php
    require "../functions.php";
    require "../config.php";
    session_start();
    if($_SESSION['user'] != "3rka"){
        header("Location: login.php");
        exit();
    }
?>