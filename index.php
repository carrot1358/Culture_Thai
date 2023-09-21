<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Culture Thai</title>
    <!-- Link Bootstrap stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Link CSS stylesheet -->
    <link rel="stylesheet" type="text/css" href="index.css">

    <!-- Link Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@1,700&family=Noto+Sans+Thai:wght@200;400;800&display=swap" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">

</head>
<body>
<!-- ***** Preloader Start ***** -->
<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- ***** Preloader End ***** -->


<!-------------------->
<!-- Navigation Bar -->
<!-------------------->
<nav class="navbar navbar-expand-lg bg-body-tertiary" id="nav-bar">
    <div class="container-fluid">
        <!--The Name of Websize-->
        <a class="navbar-brand" href="#">ประเพณีลอยกระทง</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#services">ประวัติ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ความสำคัญ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">คำแนะนำ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        กิจกรรม
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">การท่องเที่ยว</a></li>
                        <li><a class="dropdown-item" href="#">เหตุการณ์</a></li>
                        <li><a class="dropdown-item" href="#">สถานที่</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./webboard/webboard-region/board-home.php"><b>เว็บบอร์ด</b></a>
                </li>
            </ul>

        </div>
        <div class="d-flex">
            <?php

            $loginpath = "Login/Login.html";
            $register_path = "Register/register.html";
            $logout_path = "Logout/logout.php";
            $profile_path = "Profile/profile.php";
            $my_post_path = "./Profile/my-post.php";
            // Check if the user is logged in
            session_start();
            // Define a custom error handler function to convert warnings to exceptions
            function customErrorHandler($errno, $errstr, $errfile, $errline)
            {
                throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
            }

            // Set the custom error handler
            set_error_handler("customErrorHandler");

            try {
                $user_logged_in = $_SESSION['user_logged_in'];
                $user_name = $_SESSION['user_name'];
            } catch (ErrorException  $e) {
                $user_logged_in = false;
            }
            restore_error_handler();
            if ($user_logged_in) {
                // Display the user's name instead of login and register buttons
                // Display the user's name as a dropdown
                echo '<div class="btn-group">';
                echo '<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Welcome, ' . $user_name . ' </button>';
                echo '<ul class="dropdown-menu dropdown-menu-end">';
                echo '<li><a class="dropdown-item" href="' . $profile_path . '">Profile</a></li>';
                echo '<li><a class="dropdown-item" href="' . $my_post_path . '">My Posts</a></li>';
                echo '<hr>';
                echo '<li><a class="dropdown-item" href="' . $logout_path . '">Logout</a></li>';
                echo '</ul>';
                echo '</div>';
            } else {
                // Display login and register buttons
                echo '<a href="' . $loginpath . '" class="btn btn-outline-dark">Login</a>';
                echo '<a href="' . $register_path . '" class="btn btn-outline-dark">Register</a>';
            }
            ?>
        </div>
    </div>
</nav>

<!-------------------->
<!--     Header     -->
<!-------------------->
<header>
    <div class="contrainer-fluid" id="into-info">
        <h1 class="display-1">ประเพณีลอยกระทง</h1>
        <p class="lead">ประเพณีลอยกระทงคือประเพณีทางวัฒนธรรมที่พบในประเทศไทย
            เมื่อถึงช่วงเทศกาลลอยกระทงในเดือนพฤศจิกายนของทุกปี คนไทยจะทำกระทงจากกระดาษหรือใบไม้
            แล้วใส่เทียนหรือเทปไฟลงไปในกระทึง จากนั้นจะลอยกระทงลงน้ำ
            ประเพณีนี้สื่อถึงการล้างโชคชะตาและการปลดปล่อยโชคดีในปีใหม่ </p>
        <a href="#services" id="learn-more-info">ดูเพิ่มเติม</a>
    </div>
</header>

<!-------------------->
<!--    History     -->
<!-------------------->
<div id="services" class="services section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" id="section-box">
                <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                    <h6>ประวัติความเป็นมา</h6>
                    <h4><b>ประเพณี<em>ลอยกระทง</em></b></h4>
                    <p>ประเพณีลอยกระทงมีพื้นฐานทางประวัติศาสตร์อย่างน้อยตั้งแต่รัชสมัยอยุธยา
                        แม้ว่าประวัติศาสตร์เกี่ยวกับ
                        วันที่เริ่มต้นที่แน่นอนของประเพณีนี้จะยากต่อการบอกเนื่องจากมีบันทึกประวัติศาสตร์ที่ไม่แน่นอน
                        แต่มีหลาย ทฤษฎีที่อธิบายถึงรากฐานของประเพณีลอยกระทง ดังนี้:</p>
                    <div class="line-dec"></div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="naccs">
                    <div class="grid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="menu">
                                    <div class="first-thumb active">
                                        <div class="thumb">
                                            <span class="icon"><img src="assets/images/history/cultures.png"
                                                                    alt=""></span>
                                            ทางวัฒนธรรม
                                        </div>
                                    </div>
                                    <div>
                                        <div class="thumb">
                                            <span class="icon"><img src="assets/images/history/buddha.png"
                                                                    alt=""></span>
                                            ทางศาสนา
                                        </div>
                                    </div>
                                    <div class="last-thumb">
                                        <div class="thumb">
                                            <span class="icon"><img src="assets/images/history/geography.png"
                                                                    alt=""></span>
                                            ทางสภาพภูมิศาสตร์
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <ul class="nacc">
                                    <li class="active">
                                        <div>
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-6 align-self-center">
                                                        <div class="left-text">
                                                            <h4>รากฐานทางวัฒนธรรม</h4>
                                                            <p>&emsp;มีทฤษฎีบางรายที่เชื่อว่าประเพณีลอยกระทงมีมาจากประเพณีทางวัฒนธรรมเก่าแก่ ของไทย
                                                                ที่ฉลองเข้ารอบการเก็บเกี่ยวของนานาชาติ โดยการลอยกระทงเป็นส่วนหนึ่งของการเฉลิมฉลองฤดู
                                                                ใบไม้ร่วงในเขตชนบท
                                                                </p>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 align-self-center">
                                                        <div class="right-image">
                                                            <img src="assets/images/history/history3.jpg" alt="" ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div>
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-6 align-self-center">
                                                        <div class="left-text">
                                                            <h4>รากฐานทางศาสนา</h4>
                                                            <p>&emsp;มีทฤษฎีบางรายที่เชื่อว่าประเพณีลอยกระทงมีมาจากศาสนาที่มีอิทธิพลในประเทศไทย
                                                                เช่น </p>
                                                            <div class="ticks-list">
                                                                <span><i class="fa fa-check"></i> ศาสนาพุทธ</span>
                                                                <span><i class="fa fa-check"></i> ศาสนาพราหมณ์</span>
                                                            </div>
                                                            <p>&ensp;การลอยกระทงอาจเป็นการภาวนาและขอความกรุณาพระในการขอ
                                                                อภัยและความรู้สึกขอบคุณต่อน้ำแห่งชีวิตและเครื่องอำนวยความสะดวกในชีวิตประจำวัน</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 align-self-center">
                                                        <div class="right-image">
                                                            <img src="assets/images/history/history1.jpg" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-6 align-self-center">
                                                        <div class="left-text">
                                                            <h4>รากฐานทางสภาพภูมิศาสตร์</h4>
                                                            <p>&emsp;บางคนก็เชื่อว่าการลอยกระทงอาจมีความเชื่อมโยงกับสภาพภูมิศาสตร์ของ
                                                                ประเทศไทย โดยประเพณีนี้จะถูกฉลองในเวลาที่น้ำในแม่น้ำและคลองน่าสวยงาม ทำให้นักท่องเที่ยวและ
                                                                ชาวบ้านสามารถลอยกระทงได้ง่ายและสวยงามที่สุด
                                                                การลอยกระทงเป็นประเพณีที่มีความสวยงามและมีความสมบูรณ์ทางวัฒนธรรม มันส่งเสริมความรักและความ
                                                                ปรารถนาดีให้กับผู้ร่วมประเพณี และเป็นเวลาที่สำคัญในการเฉลิมฉลองวันหยุดสำคัญของประเทศไทยและใน
                                                                ชุมชนทั่วไปทั่วโลกที่มีชนิดอย่างน้อยของประชากรไทยอยู่ในพื้นที่นั้น</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 align-self-center">
                                                        <div class="right-image">
                                                            <img src="assets/images/history/history2.jpg" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="portfolio" class="our-portfolio section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-heading wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                    <h6>สถานที่จัดกิจกรรม</h6>
                    <h4>แหล่ง<em>ท่องเที่ยว</em> ประเพณีลอยกระทง</h4>
                    <div class="line-dec"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
        <div class="row">
            <div class="col-lg-12">
                <div class="loop owl-carousel">
                    <div class="item">
                        <a href="#portfolio">
                            <div class="portfolio-item">
                                <div class="thumb">
                                    <img src="assets/images/trvel/จังหวัดสุโขทัย.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>จังหวัดสุโขทัย</h4>
                                    <span>ประเพณีลอยกระทงเผาเทียน เล่นไฟ</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#portfolio">
                            <div class="portfolio-item">
                                <div class="thumb">
                                    <img src="assets/images/trvel/จังหวัดเชียงใหม่.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>จังหวัดเชียงใหม่</h4>
                                    <span>งานเทศกาลยี่เป็ง</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#portfolio">
                            <div class="portfolio-item">
                                <div class="thumb">
                                    <img src="assets/images/trvel/จังหวัดลำปาง.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>จังหวัดลำปาง</h4>
                                    <span>ล่องสะเปา จาวละกอน</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#portfolio">
                            <div class="portfolio-item">
                                <div class="thumb">
                                    <img src="assets/images/trvel/Bangkok River Festival.webp" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>กรุงเทพมหานคร</h4>
                                    <span>Bangkok River Festival</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#portfolio">
                            <div class="portfolio-item">
                                <div class="thumb">
                                    <img src="assets/images/trvel/จังหวัดตาก.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>จังหวัดตาก</h4>
                                    <span>ประเพณีลอยกระทงสายไหลประทีป 1,000 ดวง</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#portfolio">
                            <div class="portfolio-item">
                                <div class="thumb">
                                    <img src="assets/images/trvel/ร้อยเอ็ด.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>จังหวัดร้อยเอ็ด</h4>
                                    <span>งานประเพณีสมมาน้ำ คืนเพ็ง เส็งประทีป</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Link Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

<!-- Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>

<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/animation.js"></script>
<script src="assets/js/imagesloaded.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>