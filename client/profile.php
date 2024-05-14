<?php
    session_start();
    require "../config.php";
    require "../functions.php";
    $username = $_SESSION['user'];
    $query = "SELECT * FROM clients WHERE username = '$username'";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <script src="https://kit.fontawesome.com/2c1af483e4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https//fonts.googleapis.com">
    <link rel="preconnect" href="https//fonts.gstatic.com" crossorigin>
    <link href="https//fonts.googleapis.com/css2?family=Cairowght@200..1000&family=Rakkas&display=swap" rel="stylesheet">
</head>

<body class="dark-background" id="fighter-app-body">

    <div class="nav cairo-font">
        <div class="nav-left">
            <ul>
                <li><img src="../images/3rka-logo-cut.png" alt="3rka Logo"></li>
            </ul>
        </div>
        <div class="nav-right">
            <a href="../logout.php">تسجيل الخروج</a>
            <li><a href="index.html">من نحن</a></li>
        </div>
    </div>

    <div class="grid-container fighter-profile">
        <div class="profile-info">
            <div class="profile-pic" style="background-image: url(<?php echo $row['img_path']; ?>);"></div> 
            <div class="profile-name rakkas">الاسم</div>
            <div class="profile-username cairo-font">@<?php echo $username?></div>

            <div class="profile-links">
                <a class="new-link" href="">الطلبات القادمة</a>
                <a class="prev-link" href="">الطلبات القديمة</a>
                <a class="data-link" href="">البيانات كاملة</a>
            </div>

        </div>

        <div class="profile-stats">
            <div class="stat">
                <i class="fa-solid fa-cart-shopping"></i>
                <h2>الطلبات الجديدة</h2>
                <h1 class="arabic">10</h1>
            </div>
            <div class="stat">
                <i class="fa-solid fa-check-double"></i>
                <h2>الطلبات القديمة</h2>
                <h1 class="arabic">10</h1>
            </div>
            <div class="stat">
                <i class="fa-solid fa-dollar-sign"></i>
                <h2>اجمالي الدخل</h2>
                <h1 class="egp"> جــــم</h1> 
                <h1 class="arabic">10</h1>   
            </div>
        </div>
        <div class="orders">
            <div class="new-orders orders-container">
                <div class="order">
                    <div class="order-info cairo-font">
                        <div class="order-id">رقم الطلب</div>
                        <div class="order-date arabic">22/22/22 </div>
                        <div class="order-details"><a href="">تفاصيل</a></div>
                        <div class="order-status">جديد</div>
                    </div>
                </div>
        </div>

        <div class="prev-orders orders-container">
            <div class="order">
                <div class="order-info cairo-font">
                    <div class="order-id">رقم الطلب</div>
                    <div class="order-date">تاريخ الطلب</div>
                    <div class="order-details"><a href="">تفاصيل</a></div>
                    <div class="order-status">تـــم</div>

                </div>
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>
    <script>convertToIndicNumbers("arabic")</script>
</body>

