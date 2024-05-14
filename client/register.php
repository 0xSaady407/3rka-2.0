<?php
    require "../config.php";
    require "../functions.php";
    
    if($_POST['submit']){
        $error=array();

        $Fname=cleanInput($_POST['name']);
        if(!$Fname) $error[Fname] = "دخل اسمك";
        else if(!preg_match("/^[\p{Arabic} ]+$/u", $Fname)) $error[Fname] = "الاسم لازم يكون حروف عربي فقط";

        $username=cleanInput($_POST['username']);
        if($username){
            $query = "SELECT * FROM clients WHERE username = '$username'";
            $result = mysqli_query($mysqli, $query);
            if(mysqli_num_rows($result) > 0) $error[username] = "اسم المستخدم مستخدم بالفعل";
        }
        if(!$username) $error[username] = "دخل اسم المستخدم";

        $password=cleanInput($_POST['password']);
        $cpassword=cleanInput($_POST['confirm-password']);
        if(!$password) $error[password]="دخل كلمة مرور";
        if($cpassword!=$password) $error[cpassword]="كلمة المرور غير متطابقة";
        if($password) $password=md5($password);

        $phone_no=cleanInput($_POST['phone-number']);
        if(!$phone_no)$error[phone_no]="دخل رقم تليفونك";
        else if(!ctype_digit($phone_no) || strlen($phone_no)!=11|| $phone_no[0]!=0 || $phone_no[1]!=1){
            $error[phone_no]="الرقم غير صحيح! دخل رقم مصري صحيح";
        }

        $email=cleanInput($_POST['email']);
        if(!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error[email]= "الإيميل غير صحيح، دخل ايميل مظبوط";
        }
        
        $img_path="";
        if(isset($_FILES['client-image'])){
            $img_name=$_FILES['client-image']['name'];
            $img_size=$_FILES['client-image']['size'];
            $img_tmp=$_FILES['client-image']['tmp_name'];
            $img_type=$_FILES['client-image']['type'];
            $img_ext=strtolower(end(explode('.',$img_name)));
            $img_name=$phone_no."img.".$img_ext;
            $avl_ext=array('jpeg','jpg','png');
            if($img_size>2097152) $error[img]="الصورة كبيرة جدا";
            else if(!in_array($img_ext,$avl_ext)) $error[img]="مسموح ب png, jpg, jpeg فقط";
            if(empty($error['image'])){
                $upload_dir = "uploads/";
                $target_file = $upload_dir.basename($img_name);
                move_uploaded_file($_FILES["client-image"]["tmp_name"], $target_file);
                $img_path=$target_file;
            }
        }

        if(empty($error)){
            $sql="INSERT INTO `clients` (`Fname`, `username`, `password`, `phone_no`,`email`, `birth_date`,`img_path`) VALUES ('$Fname', '$username', '$password', '$phone_no', '$email', '$birth_date', '$img_path')";
            if(mysqli_query($mysqli,$sql)){
                header("Location: login.php");
                exit();
            }
            else{
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
    <link rel="preconnect" href="https//fonts.googleapis.com">
    <link rel="preconnect" href="https//fonts.gstatic.com" crossorigin>
    <link href="https//fonts.googleapis.com/css2?family=Cairowght@200..1000&family=Rakkas&display=swap" rel="stylesheet">
</head>

<body class="background">

    <div class="nav cairo-font">
        <div class="nav-left">
            <ul>
                <li><img src="../images/3rka-logo-cut.png" alt="3rka Logo"></li>
            </ul>
        </div>
        <div class="nav-right">
            <a href="login.php">تسجيل الدخول</a>
            <li><a href="index.html">من نحن</a></li>
        </div>
    </div>

    <div class="registration-form cairo-font">
        
        <form class="grid-container" id="registration-form" method="post" enctype="multipart/form-data">
            <h2 class="registration-title rakkas">عميل جديد</h2>
            <div class="form-group full-name">
                <label for="name" class="label-name",>الاسم كامل</label>
                <input type="text" id="name" name="name" class="input-name" required>
                <span class="error"> 
                    <?php echo $error[Fname]?>
                </span>
            </div>
            <div class="form-group username">
                <label for="username" class="label-username">اسم المستخدم</label>
                <input type="text" id="username" name="username" class="input-username" required>
                <span class="error"> 
                    <?php echo $error[username]?>
                </span>
            </div>
            <div class="form-group email">
                <label for="email" class="label-email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" class="input-email" required>
                <span class="error"> 
                    <?php echo $error[email]; ?>
                </span>
            </div>
            <div class="form-group password">
                <label for="password" class="label-password">كلمة السر</label>
                <input type="password" id="password" name="password" class="input-password" required></div>
                <span class="error"> 
                    <?php echo $error[password]?>
                </span>
            <div class="form-group confirm-password">
                <label for="confirm-password" class="label-password">تأكيد كلمة السر </label>
                <input type="password" id="confirm-password" name="confirm-password" class="input-confirm-password" required>
                <span class="error"> 
                    <?php echo $error[cpassword]?>
                </span>
            </div>
            <div class="form-group phone-number">
                <label for="phone-number" class="label-phone-number">رقم الهاتف</label>
                <input type="tel" id="phone-number" name="phone-number" class="input-phone-number" required>
                <span class="error"> 
                    <?php echo $error[phone_no]?>
                </span>
            </div>
            <div class="form-group guide-officer">
                <label for="checkbox1" class="label-checkbox">هل انت مرشد أو ظابط؟</label>
                <input type="checkbox" id="checkbox1" class="input-checkbox">
            </div>
            <div class="form-group oath">
                <label for="checkbox2" class="label-checkbox">والله؟</label>
                <input type="checkbox" id="checkbox2" class="input-checkbox">
            </div>
            
            <div class="client-image">
                <div class="client-image-border">
                    <input type="file" name="client-image">
                    <span class="error"> 
                        <?php echo $error[img]?>
                    </span>
                </div>
            </div>
            
            <input type="submit" class="button" name="submit" value="تمام!"></input>
        </form>
    </div>
</div>

</body>
</html>