<?php
    session_start();
    require "../config.php";
    require "../functions.php";

    if($_SESSION['user'] == "3rka"){
        header("Location: choose.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $error = array(
            "username" => "",
            "password" => ""
        );
        $username = $_POST['username'];
        $username = cleanInput($username);
        if(empty($username)) $error['username'] = "دخل اسم مستخدم صحيح";


        $password = $_POST['password'];
        $password = cleanInput($password);
        if(empty($password)) $error['password'] = "دخل كلمة مرور صحيحة";
        else $password = md5($password);

        if($error == ["username" => "" ,"password" => ""]){
            $adminPass = md5("1234");
            $adminUser = "3rka";
            if($adminPass == $password && $adminUser == $username ){
                $_SESSION['user'] = "3rka";
                header("Location: session.php");
                exit();
            }
            else {
                $error['password'] = "اسم المستخدم أو كلمة المرور غير صحيحة";
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
<body id="client-login-body" class="cairo-font">

    <div class="nav cairo-font  ">
        <div class="nav-left">
            <ul>
                <li><img src="../images/3rka-logo-cut.png" alt="3rka Logo"></li>
            </ul>
        </div>
    </div>

    <div class="grid-container">
        <div id="login-form">
            <form action="login.php" method="post">
                <h1>تسجيل الدخول</h1>
                <div class="form-group">
                    <div class="label-input-group">
                        <label for="username">اسم المستخدم</label>
                        <input type="text" name="username" id="username" required>
                        <span class="error">
                            <?php echo $error['username'];?>
                        </span>
                    </div>
                    <div class="label-input-group">
                        <label for="password">كلمة السر</label>
                        <input type="password" name="password" id="password" required>
                        <span class="error">
                            <?php echo $error['password'];?>
                        </span>
                    </div>

                    <input type="submit" class="button red-button submit" value="تأكيد"></input>
        </div>
        
    </div>

</body>
</html>