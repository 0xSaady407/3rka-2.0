<?php
    require "../config.php";
    require "../functions.php";
        
    if($_POST['submit']){
        $error=array();

        $Fname=cleanInput($_POST['name']);
        if(!$Fname) $error[Fname] = "دخل اسمك";
        else {
            if(!preg_match("/^[\p{Arabic} ]+$/u", $Fname)) $error[Fname] = "الاسم لازم يكون حروف عربي فقط";
        }
        
        $username=cleanInput($_POST['username']);
        if(!$username) $error[username] = "دخل اسم المستخدم";
        else{
            if(!preg_match("/^[\p{Arabic} ]+$/u", $username)) $error[username] = "الاسم لازم يكون حروف عربي فقط";
        }
        
        $nickname=cleanInput($_POST['fame-name']);
        if(!$nickname){
            $error[nickname] = "دخل اسم الشهرة";
        }
        else{
            if(!preg_match("/^[\p{Arabic} ]+$/u", $nickname)) $error[nickname] = "الاسم لازم يكون حروف عربي فقط";
        }

        $password=cleanInput($_POST['password']);
        $cpassword=cleanInput($_POST['confirm-password']);
        if(!$password) $error[password]="دخل كلمة مرور";
        if($cpassword!=$password) $error[cpassword]="كلمة المرور غير متطابقة";
        if($password) $password=md5($password);
        
        $phone_no=cleanInput($_POST['phone-number']);
        if(!$phone_no) $error[phone_no]="دخل رقم تليفونك";
        else if(!ctype_digit($phone_no) || strlen($phone_no)!=11|| $phone_no[0]!=0 || $phone_no[1]!=1){
            $error[phone_no]="الرقم غير صحيح! دخل رقم مصري صحيح";
        }

        $email=cleanInput($_POST['email']);
        if(!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error[email]= "الإيميل غير صحيح، دخل ايميل مظبوط";
        }

        $birth_date=date('Y-m-d', strtotime($_POST['date-of-birth']));
        if(empty($_POST['date-of-birth'])) $error[date]= "دخل تاريخ ميلادك";

        $address=cleanInput($_POST['address']);
        if(!$address) $error[address]= "العنوان مينفعش يبقى فاضي، دخل عنوان صحيح";

        $Main_Weapon=cleanInput($_POST['favorite-weapon']);
        // if(!$Main_Weapon ){
        //     $error[Main_Weapon]= "invalid weapon";
        // }
        $img_path="";
        $card_path="";
        $fesh_path="";
        if(isset($_FILES['record-doc'])){
            echo "<script> alert(\"record\")</script>";
            $img_name=$_FILES['record-doc']['name'];
            $img_size=$_FILES['record-doc']['size'];
            $img_tmp=$_FILES['record-doc']['tmp_name'];
            $img_type=$_FILES['record-doc']['type'];
            $img_ext=strtolower(end(explode('.',$img_name)));
            $img_name=$phone_no."record.".$img_ext;
            $avl_ext=array('jpeg','jpg','png');
            if($img_size>2097152) $error[fesh]="الصورة كبيرة جدا";
            else if(!in_array($img_ext,$avl_ext)) $error[fesh]="مسموح ب png, jpg, jpeg فقط";
            if(empty($error['image'])){
                $upload_dir = "uploads/";
                $target_file = $upload_dir.basename($img_name);
                move_uploaded_file($_FILES["record-doc"]["tmp_name"], $target_file);
                $fesh_path=$target_file;
            }
        }
        if(isset($_FILES['id-card'])){
            $img_name=$_FILES['id-card']['name'];
            $img_size=$_FILES['id-card']['size'];
            $img_tmp=$_FILES['id-card']['tmp_name'];
            $img_type=$_FILES['id-card']['type'];
            $img_ext=strtolower(end(explode('.',$img_name)));
            $img_name=$phone_no."card.".$img_ext;
            $avl_ext=array('jpeg','jpg','png');
            if($img_size>2097152) $error[card]="الصورة كبيرة جدا";
            else if(!in_array($img_ext,$avl_ext)) $error[card]="مسموح ب png, jpg, jpeg فقط";
            if(empty($error['image'])){
                $upload_dir = "uploads/";
                $target_file = $upload_dir.basename($img_name);
                move_uploaded_file($_FILES["id-card"]["tmp_name"], $target_file);
                $card_path=$target_file;
            }
        }
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
            $sql="INSERT INTO `fighters` (`Fname`, `username`, `nick_name`, `password`, `phone_no`,`email`, `birth_date`, `address`, `Main_Weapon`,`img_path`,`fesh_path`,`card_path`) VALUES ('$Fname', '$username', '$nick_name', '$password', '$phone_no', '$email', '$birth_date', '$address', '$Main_Weapon','$img_path','$fesh_path','$card_path')";
            if(mysqli_query($mysqli,$sql)){
                echo "<script> alert(\"data inserted successfully\")</script>";
            }
            else{
                echo "<script> alert(\"not inserted\")</script>";
            }
        }
        else{
            echo "<script> alert(\"error\")</script>";
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

<body   class="dark-background" id="fighter-app-body">

    <div class="nav cairo-font">
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

    <div class="section" id="section1">
        <form class="grid-container fighter-application fighter-section" method="post" enctype="multipart/form-data">
            <h1 class="registration-title">بيانات شخصية</h1>
            <div class="form-group full-name">
                <label for="name">الاسم</label>
                <input type="text" id="name" name="name">
                <span style="font-size: 10px;"> 
                    <?php echo $error[Fname]?>
                </span>
            </div>

            <div class="form-group username">
                <label for="username">اسم المستخدم</label>
                <input type="text" id="username" name="username">
                <span style="font-size: 10px;"> 
                    <?php echo $error[username]; ?>
                </span>
            </div>

            <div class="form-group password">
                <label for="password">كلمة المرور</label>
                <input type="password" id="password" name="password">
                <span style="font-size: 10px;"> 
                    <?php echo $error[password]; ?>
                </span>
            </div>

            <div class="form-group confirm-password">
                <label for="confirm-password">تأكيد كلمة المرور</label>
                <input type="password" id="confirm-password" name="confirm-password">
                <span style="font-size: 10px;"> 
                    <?php echo $error[cpassword]; ?>
                </span>
            </div>

            <div class="form-group date-of-birth">
                <label for="date-of-birth">تاريخ الميلاد</label>
                <input type="date" id="date-of-birth" name="date-of-birth">
                <span class="error"> 
                    <?php echo $error[date]; ?>
                </span>
            </div>

            <div class="form-group email">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email">
                <span style="font-size: 10px;"> 
                    <?php echo $error[email]; ?>
                </span>
            </div>

            <div class="form-group address">
                <label for="address">العنوان</label>
                <input type="text" id="address" name="address">
                <span style="font-size: 10px;"> 
                    <?php echo $error[address]; ?>
                </span>
            </div>

            <div class="form-group phone-number">
                <label for="phone-number">رقم الهاتف</label>
                <input type="tel" id="phone-number" name="phone-number">
                <span style="font-size: 10px;"> 
                    <?php echo $error[phone_no]; ?>
                </span>
            </div>

            <div class="client-image">
                <div class="client-image-border">
                    <input type="file" name="client-image">
                    <span style="font-size: 10px;"> 
                        <?php echo $error[image]; ?>
                    </span>
                </div>
            </div>
            <a href="#section2" class="button small-button" style="text-decoration: none;">اللي بعده!</a>

        </form>

    </div>
    <div class="section" id="section2">
        <form class="grid-container fighter-application fighter-section" method="post" enctype="multipart/form-data">

            <h1 class="registration-title">بيانات اجرامية</h1>
            <div class="form-group full-name">
                <label for="fame-name">اسم الشهرة</label>
                <input type="text" id="fame-name" name="fame-name">
                <?php echo $error[nickname] ?>
            </div>

            <div class="form-group criminal-record">
                <label for="criminal-record">سجلك الإجرامي باختصار</label>
                <textarea name="criminal-record" id="criminal-record"></textarea>
            </div>

            <div class="record-doc form-group">
                    <label for="record-doc">صورة الفيش والتشبيه</label>
                    <input type="file" name="record-doc">
                    <span style="font-size: 10px;"> 
                        <?php echo $error[fesh] ?>
                    </span>
            </div>

            <div class="id-card form-group">
                <label for="id-card">صورة البطاقة</label>
                <input type="file" name="id-card">
                <span style="font-size: 10px;"> 
                    <?php echo $error[card] ?>
                </span>
            </div>

            <div class="form-group favorite-weapon">
                <label for="favorite-weapon">سلاحك المفضل</label>
                <select id="favorite-weapon" name="favorite-weapon">
                    <option value="sword">سيف</option>
                    <option value="axe">فأس</option>
                    <option value="bow">قوس</option>
                    <option value="dagger">خنجر</option>
                </select>
            </div>

            
            <a href="#section3" class="button small-button" style="text-decoration: none;">اللي بعده!</a>

        </form>
    </div>
    <div class="section" id="section3">
        <form action="" class="grid-container fighter-application">
            <h1 class="registration-title">المهارات</h1>
            <div class="skills flex">
                <div class="skill">
                    <h3>مهارة</h3>
                    <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                </div>

                    <div class="skill">
                        <h3>مهارة</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>

                    <div class="skill">
                        <h3>مهارة</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>

                    <div class="skill">
                        <h3>مهارة</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>

                    <div class="skill">
                        <h3>مهارة</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>

                    <div class="skill">
                        <h3>مهارة</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>
                    <div class="skill">
                        <h3>مهارة</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>
                    <div class="skill">
                        <h3>مهارة</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>
                    <div class="skill">
                        <h3>مهارة</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>
                    
                    <div class="arrows">
                        <a href="#section2" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-right"></i></a>
                        <a href="#section4" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-left"></i></a>
                    </div>
            </div>
        </form>
    </div>
    <input type="submit" value="Submit All Data" name="submit">
    <div class="section" id="section1">
        <div class="grid-container">
            <h1>التقديم كبلطجي</h1>
        </div>
    </div>

</body>