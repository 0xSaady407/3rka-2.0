<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/2c1af483e4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https//fonts.googleapis.com">
    <link rel="preconnect" href="https//fonts.gstatic.com" crossorigin>
    <link href="https//fonts.googleapis.com/css2?family=Cairowght@200..1000&family=Rakkas&display=swap" rel="stylesheet">
</head>

<body class="dark-background order-body">

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

    <form method="post">
        
        <div class="section" id="section1">
            <div class="grid-container fighter-section fighter-application">
                <h1 class="registration-title">الخناقة<br>فين؟</h1>
                <i class="fa-solid fa-location-dot icon"></i>
                <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d65724.39973160389!2d31.330800169080383!3d30.030739124146884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145840c0d951113d%3A0x3cd085938aad3157!2z2YPYtNix2Yog2KPYqNmIINi32KfYsdmC!5e0!3m2!1sar!2seg!4v1715475133212!5m2!1sar!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <a href="#section4" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-left"></i></a>
            </div>

        </div>

        <div class="section" id="section4">
            <div class="grid-container fighter-application fighter-section">
                <h1 class="registration-title">الأسلحة اللي محتاجها؟</h1>
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
                        
                        <div class="arrows">
                            <a href="#section1" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-right"></i></a>
                            <a href="#section3" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-left"></i></a>
                        </div>
                </div>
            </div>
        </div>

        <div class="section" id="section3">
            <div class="grid-container fighter-section fighter-application">
                <h1 class="registration-title">تفاصيل<br>الخناقة</h1>
                <textarea class="order-details" name="order-details" id="order-details"></textarea>
                
                <div class="arrows">
                    <a href="#section4" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-right"></i></a>
                    <a href="#section5" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
            </div>
        </div>

        <div class="section" id="section5">
            <div class="grid-container fighter-section fighter-application">
                <h1 class="registration-title">اختار الرجالة</h1>
                <div class="men flex">
                    <div class="card">
                        <div class="fighter-pic"></div>
                        <p class="fighter-crecord">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet odio aspernatur dolore at non nemo, sint voluptatibus, odit, error sequi fugit? Molestias eaque suscipit ea consectetur dolor laborum delectus labore.</p>
                        <h1 class="fighter-name-1">الإسم</h1>
                        <h1 class="egp">جـم</h1>
                        <h1 class="arabic">100</h1>
                        <img class="fighter-weapon-1" src="../images/knife.webp" alt="">
                        <input type="checkbox" name="card-checkbox" id="card-checkbox" onchange="cardColor()"">
                    </div>

                    <div class="card">
                        <div class="fighter-pic"></div>
                        <p class="fighter-crecord">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet odio aspernatur dolore at non nemo, sint voluptatibus, odit, error sequi fugit? Molestias eaque suscipit ea consectetur dolor laborum delectus labore.</p>
                        <h1 class="fighter-name-1">الإسم</h1>
                        <h1 class="egp">جـم</h1>
                        <h1 class="arabic">100</h1>
                        <img class="fighter-weapon-1" src="../images/knife.webp" alt="">
                        <input type="checkbox" name="card-checkbox" id="card-checkbox" onchange="cardColor()"">
                    </div>

                    <div class="card">
                        <div class="fighter-pic"></div>
                        <p class="fighter-crecord">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet odio aspernatur dolore at non nemo, sint voluptatibus, odit, error sequi fugit? Molestias eaque suscipit ea consectetur dolor laborum delectus labore.</p>
                        <h1 class="fighter-name-1">الإسم</h1>
                        <h1 class="egp">جـم</h1>
                        <h1 class="arabic">100</h1>
                        <img class="fighter-weapon-1" src="../images/knife.webp" alt="">
                        <input type="checkbox" name="card-checkbox" id="card-checkbox" onchange="cardColor()"">
                    </div>

                    <div class="card">
                        <div class="fighter-pic"></div>
                        <p class="fighter-crecord">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet odio aspernatur dolore at non nemo, sint voluptatibus, odit, error sequi fugit? Molestias eaque suscipit ea consectetur dolor laborum delectus labore.</p>
                        <h1 class="fighter-name-1">الإسم</h1>
                        <h1 class="egp">جـم</h1>
                        <h1 class="arabic">100</h1>
                        <img class="fighter-weapon-1" src="../images/knife.webp" alt="">
                        <input type="checkbox" name="card-checkbox" id="card-checkbox" onchange="cardColor()"">
                    </div>

                    <div class="card">
                        <div class="fighter-pic"></div>
                        <p class="fighter-crecord">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet odio aspernatur dolore at non nemo, sint voluptatibus, odit, error sequi fugit? Molestias eaque suscipit ea consectetur dolor laborum delectus labore.</p>
                        <h1 class="fighter-name-1">الإسم</h1>
                        <h1 class="egp">جـم</h1>
                        <h1 class="arabic">100</h1>
                        <img class="fighter-weapon-1" src="../images/knife.webp" alt="">
                        <input type="checkbox" name="card-checkbox" id="card-checkbox" onchange="cardColor()"">
                    </div>

                    <div class="card">
                        <div class="fighter-pic"></div>
                        <p class="fighter-crecord">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet odio aspernatur dolore at non nemo, sint voluptatibus, odit, error sequi fugit? Molestias eaque suscipit ea consectetur dolor laborum delectus labore.</p>
                        <h1 class="fighter-name-1">الإسم</h1>
                        <h1 class="egp">جـم</h1>
                        <h1 class="arabic">100</h1>
                        <img class="fighter-weapon-1" src="../images/knife.webp" alt="">
                        <input type="checkbox" name="card-checkbox" id="card-checkbox" onchange="cardColor()"">
                    </div>
                </div>
                
                <div class="buttons">
                    <a href="#section3" class="button small-button" style="text-decoration: none;"><i class="fa-solid fa-arrow-right"></i></a>
                    <input type="submit" value="تمام!" class="button small-button">
                </div>
            </div>
        </div>


    </form>
    <script src="../js/script.js"></script>
    <script>convertToIndicNumbers("arabic");</script>
</body>