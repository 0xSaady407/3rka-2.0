<?php
    require "../functions.php";
    require "../config.php";
    session_start();
    if($_SESSION['user'] != "3rka"){
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <body>
        <button onclick="location.href='orders.php'">خناقات</button>
        <button onclick="location.href='fighters.php'">بلطجية</button>
    </body>
</html>