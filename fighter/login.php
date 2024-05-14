<?php
    session_start();
    require "../config.php";
    require "../functions.php";

    if(isset($_SESSION['user'])){
        if($_SESSION['role'] != "fighter" && $_SESSION['role'] != "admin"){
            header("Location: ../client/profile.php");
            exit();
        } else {
            header("Location: profile.php");
            exit();
        }
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        $error = array(
            "username" => "",
            "password" => ""
        );
        $username = $_POST['username'];
        $username = cleanInput($username);
        if(empty($username)) $error['username'] = "دخل ايميل او اسم مستخدم صحيح";

        $password = $_POST['password'];
        $password = cleanInput($password);
        if(empty($password)) $error['password'] = "دخل كلمة مرور صحيحة";
        else $password = md5($password);

        if ($error == ["username" => "", "password" => ""]) {
            $query = $mysqli->prepare("SELECT * FROM fighters WHERE password = ? AND (username = ? OR email = ?) AND confirmed = 1");
            $query->bind_param("sss", $password, $username, $username);
            
            if ($query->execute()) {
                $result = $query->get_result();
                $num_rows = $result->num_rows;

                if ($num_rows === 0) {
                    $error['password'] = "مستخدم غير موجود أو لم يتم قبوله بعد";
                } else {
                    $row = $result->fetch_assoc();
                    $_SESSION['user'] = $username;
                    $_SESSION['role'] = "fighter";
                    header('Location: profile.php');
                    exit();
                }
            }
            else {
                header("Location: ../error.php");
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Rakkas&display=swap" rel="stylesheet">
</head>
<body id="login-body" class="cairo-font">

    <div class="nav cairo-font  ">
        <div class="nav-left">
            <ul>
                <li><img src="../images/3rka-logo-cut.png" alt="3rka Logo"></li>
            </ul>
        </div>
        <div class="nav-right">
            <a href="login.html">تسجيل الدخول</a>
            <li><a href="index.html">من نحن</a></li>
        </div>
    </div>

    <div class="grid-container">
        <div id="login-form">
            <form action="login.php" method="post">
                <h1>تسجيل الدخول</h1>
                <div class="form-group">
                    <div class="label-input-group">
                        <label for="username">اسم المستخدم أو الإيميل</label>
                        <input type="text" name="username" id="username" required>
                        <span class="error">
                            <?php
                                echo $error['username'];
                            ?>
                        </span>
                    </div>
                    <div class="label-input-group">
                        <label for="password">كلمة السر</label>
                        <input type="password" name="password" id="password" required>
                        <span class="error">
                            <?php
                                echo $error['password'];
                            ?>
                        </span>
                    </div>

                    <h5>لسة مش مسجل؟ اعمل <a href="apply.php">حساب جديد</a></h5>
                    

                    <button type="submit" class="button red-button submit">تأكيد</button>
        </div>
        
    </div>

</body>
</html>