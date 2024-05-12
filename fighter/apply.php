<?php
    require "../config.php";
    require "../functions.php";
        
    if($_POST['submit']){
        $error=array();
        $skills = $_POST['skill'];
        if(empty($skills)) $error[skills] = "اختر مهارة واحدة على الأقل";
        print_r($skiils);
        
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
        if(!$nickname) $error[nickname] = "دخل اسم الشهرة";
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
        
        $details=cleanInput($_POST['criminal-record']);
        if(empty($details)) $error[details] = "دخل تفاصيل الخناقة، لو مفيش اكتب لا يوجد";
        $img_path="";
        $card_path="";
        $fesh_path="";

        if(isset($_FILES['record-doc'])){
            $img_name=$_FILES['record-doc']['name'];
            $img_size=$_FILES['record-doc']['size'];
            $img_tmp=$_FILES['record-doc']['tmp_name'];
            $img_type=$_FILES['record-doc']['type'];
            $img_ext=strtolower(end(explode('.',$img_name)));
            $img_name=$phone_no."fesh.".$img_ext;
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
            $sql="INSERT INTO `fighters` (`Fname`, `username`, `nick_name`, `password`, `phone_no`,`email`, `birth_date`, `address`, `Main_Weapon`,`img_path`,`fesh_path`,`card_path`,`details`) VALUES ('$Fname', '$username', '$nickname', '$password', '$phone_no', '$email', '$birth_date', '$address', '$Main_Weapon','$img_path','$fesh_path','$card_path','$details')";
            foreach($skill as $skills){
                $sql="INSERT INTO `fighter_skills` (`Fusername`, `skill`) VALUES ('$username', $skill')";
                mysqli_query($mysqli, $sql);
            }
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
    <script src="https://kit.fontawesome.com/2c1af483e4.js" crossorigin="anonymous"></script>
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
            <a href="login.php">تسجيل الدخول</a>
            <li><a href="index.html">من نحن</a></li>
        </div>
    </div>

    <form method="post" enctype="multipart/form-data">
        <div class="section" id="section1">
            <div class="grid-container fighter-application fighter-section">
                <h1 class="registration-title">بيانات شخصية</h1>
                <div class="form-group full-name">
                    <label for="name">الاسم</label>
                    <input type="text" id="name" name="name">
                    <span class="error"> 
                        <?php echo $error[Fname] ?>
                    </span>
                </div>

                <div class="form-group username">
                    <label for="username">اسم المستخدم</label>
                    <input type="text" id="username" name="username">
                    <span class="error"> 
                        <?php echo $error[username] ?>
                    </span>
                </div>

                <div class="form-group password">
                    <label for="password">كلمة المرور</label>
                    <input type="password" id="password" name="password">
                    <span class="error"> 
                        <?php echo $error[password] ?>
                    </span>
                </div>

                <div class="form-group confirm-password">
                    <label for="confirm-password">تأكيد كلمة المرور</label>
                    <input type="password" id="confirm-password" name="confirm-password">
                    <span class="error"> 
                        <?php echo $error[cpassword] ?>
                    </span>
                </div>

                <div class="form-group date-of-birth">
                    <label for="date-of-birth">تاريخ الميلاد</label>
                    <input type="date" id="date-of-birth" name="date-of-birth">
                    <span class="error"> 
                        <?php echo $error[date] ?>
                    </span>
                </div>

                <div class="form-group email">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email">
                    <span class="error"> 
                        <?php echo $error[email] ?>
                    </span>
                </div>

                <div class="form-group address">
                    <label for="address">العنوان</label>
                    <input type="text" id="address" name="address">
                    <span class="error"> 
                        <?php echo $error[address] ?>
                    </span>
                </div>

                <div class="form-group phone-number">
                    <label for="phone-number">رقم الهاتف</label>
                    <input type="tel" id="phone-number" name="phone-number">
                    <span class="error"> 
                        <?php echo $error[phone_no] ?>
                    </span>
                </div>

                <div class="client-image">
                    <div class="client-image-border">
                        <input type="file" name="client-image">
                        <span class="error"> 
                            <?php echo $error[img] ?>
                        </span>
                    </div>
                </div>
                <a href="#section2" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-left"></i></a>
            </div>

        </div>
        

    </div>
    <div class="section" id="section2">
        <div class="grid-container fighter-application fighter-section">

            <h1 class="registration-title">بيانات اجرامية</h1>
            <div class="form-group full-name">
                <label for="fame-name">اسم الشهرة</label>
                <input type="text" id="fame-name" name="fame-name">
                <span class="error"> 
                    <?php echo $error[nickname] ?>
                </span>
            </div>

            <div class="form-group criminal-record">
                <label for="criminal-record">سجلك الإجرامي باختصار</label>
                <textarea name="criminal-record" id="criminal-record"></textarea>
                <span class="error"> 
                    <?php echo $error[details] ?>
                </span>
            </div>

            <div class="record-doc form-group">
                    <label for="record-doc">صورة الفيش والتشبيه</label>
                    <input type="file" name="record-doc">
                    <span class="error"> 
                        <?php echo $error[fesh] ?>
                    </span>
            </div>

            <div class="id-card form-group">
                <label for="id-card">صورة البطاقة</label>
                <input type="file" name="id-card">
                <span class="error"> 
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

            <div class="arrows">
                <a href="#section1" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-right"></i></a>
                <a href="#section3" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
        </div>
    </div>
    <div class="section" id="section3">
        <div class="grid-container fighter-application fighter-section">
            <h1 class="registration-title">المهارات</h1>
            <div class="skills flex">

                <div class="skill">
                    <h3>قوة الجسم</h3>
                    <input type="checkbox" name="skill[]" id="skill" onclick="checkboxChangeColor()">
                </div>

                    <div class="skill">
                        <h3>تعوير</h3>
                        <input type="checkbox" name="skill[]" id="skill" onclick="checkboxChangeColor()">
                    </div>

                    <div class="skill">
                        <h3>مدى بعيد</h3>
                        <input type="checkbox" name="skill[]" id="skill" onclick="checkboxChangeColor()">
                    </div>

                    <div class="skill">
                        <h3>مدى قصير</h3>
                        <input type="checkbox" name="skill[]" id="skill" onclick="checkboxChangeColor()">
                    </div>

                    <div class="skill">
                        <h3>سرعة</h3>
                        <input type="checkbox" name="skill[]" id="skill" onclick="checkboxChangeColor()">
                    </div>

                    <div class="skill">
                        <h3>فورمة</h3>
                        <input type="checkbox" name="skill[]" id="skill" onclick="checkboxChangeColor()">
                    </div>
                    <div class="skill">
                        <h3>الإقناع</h3>
                        <input type="checkbox" name="skill[]" id="skill" onclick="checkboxChangeColor()">
                    </div>
                    <div class="skill">
                        <h3>الهروب</h3>
                        <input type="checkbox" name="skill[]" id="skill" onclick="checkboxChangeColor()">
                    </div>
                    <div class="skill">
                        <h3>عصب</h3>
                        <input type="checkbox" name="skill[]" id="skill" onclick="checkboxChangeColor()">
                    </div>
                    
                    <div class="arrows">
                        <a href="#section2" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-right"></i></a>
                        <a href="#section4" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-left"></i></a>
                    </div>
            </div>
        </div>
    </div>
    <div class="section" id="section4">
        <div class="grid-container fighter-application fighter-section">
            <h1 class="registration-title">الأسلحة الممتلكة</h1>
            <div class="skills flex">
                
                    <div class="skill weapon">
                        <img src="../images/ak.webp" alt="">
                        <h3>آلي</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>

                    <div class="skill weapon">
                        <img src="../images/knife.webp" alt="">
                        <h3>مطواة</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>

                    <div class="skill weapon">
                        <img src="../images/blade.webp" alt="">
                        <h3>موس</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>

                    <div class="skill weapon">
                        <img src="../images/machete.webp" alt="">
                        <h3>سنجة</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>

                    <div class="skill weapon">
                        <img src="../images/pistol.webp" alt="">
                        <h3>طبنجة</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>
                    <div class="skill weapon">
                        <img src="../images/chain.webp" alt="">
                        <h3>جنزير</h3>
                        <input type="checkbox" name="skill" id="skill" onclick="checkboxChangeColor()">
                    </div>
                    
                    <div class="buttons">
                        <a href="#section3" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-right"></i></a>
                        <input type="submit" value="تمام!" class="button small-button" name="submit">
                    </div>
                        
                
            </div>
            </div>
        </form>
    </div>
    <script src="../js/script.js"></script>
</body>