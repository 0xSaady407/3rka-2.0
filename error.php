<?php
    require "functions.php";
    require "config.php";
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <title>عركة - تم</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <script src="https://kit.fontawesome.com/2c1af483e4.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
    <div class="thanks-page error-page">
        <i class="fa-solid fa-circle-xmark"></i>
        <h1>خطأ!</h1>
        <div class="thanks-paragraph">
            <p>حدث خطأ ما الرجاء المحاولة مرة أخرى لاحقاً.</p>
        </div>
        <div class="return">
            <a href="index.html" id="submit_app">الصفحة الرئيسية <i class="fa-solid fa-angles-left"></i></a>
        </div>
    </div>
</body>
</html>