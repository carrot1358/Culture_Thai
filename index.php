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
    <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@1,700&family=Noto+Sans+Thai:wght@800&display=swap"
          rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ศิลปวัฒนธรรมไทย</a>
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
                    <a class="nav-link" href="./webboard/webboard-region/board-home.php">Webboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        วัฒนธรรมไทยในภาคต่างๆ
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">ภาคเหนือ</a></li>
                        <li><a class="dropdown-item" href="#">ภาคตะวันออกเฉียงเหนือ</a></li>
                        <li><a class="dropdown-item" href="#">ภาคกลาง</a></li>
                        <li><a class="dropdown-item" href="#">ภาคใต้</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <div class="d-flex">
            <?php

                $loginpath="Login/Login.html";
                $register_path = "Register/register.html";
                $logout_path = "Logout/logout.php";
                $profile_path = "Profile/profile.php";
                $my_post_path = "./Profile/my-post.php";
                // Check if the user is logged in
                session_start();
                // Define a custom error handler function to convert warnings to exceptions
            function customErrorHandler($errno, $errstr, $errfile, $errline) {
                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
                }
                // Set the custom error handler
                set_error_handler("customErrorHandler");

                try{
                    $user_logged_in = $_SESSION['user_logged_in'];
                    $user_name = $_SESSION['user_name'];
                }catch (ErrorException  $e){
                    $user_logged_in = false;
                }
                restore_error_handler();
                if ($user_logged_in) {
                    // Display the user's name instead of login and register buttons
                    // Display the user's name as a dropdown
                    echo '<div class="btn-group">';
                    echo  '<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Welcome, '.$user_name.' </button>';
                    echo  '<ul class="dropdown-menu dropdown-menu-end">';
                    echo    '<li><a class="dropdown-item" href="' . $profile_path . '">Profile</a></li>';
                    echo    '<li><a class="dropdown-item" href="' . $my_post_path . '">My Posts</a></li>';
                    echo    '<hr>';
                    echo    '<li><a class="dropdown-item" href="' . $logout_path . '">Logout</a></li>';
                    echo '</ul>';
                    echo '</div>';
                } else {
                    // Display login and register buttons
                    echo '<a href="'.$loginpath.'" class="btn btn-outline-dark">Login</a>';
                    echo '<a href="'. $register_path .'" class="btn btn-outline-dark">Register</a>';
                    }
            ?>
        </div>
    </div>
</nav>

<header>
    <div class="contrainer-fluid" id="into-info">
        <h1 class="display-1">ศิลปวัฒนธรรมไทย</h1>
        <p class="lead">ศิลปวัฒนธรรมไทย คือ ศิลปะและวัฒนธรรมของชาวไทย
            ซึ่งมีลักษณะเฉพาะตัวที่แตกต่างจากศิลปะและวัฒนธรรมของชนบทในภูมิภาคเอเชียตะวันออกเฉียงใต้
            และมีลักษณะเฉพาะตัวที่แตกต่างจากศิลปะและวัฒนธรรมของชนบทในภูมิภาคเอเชียตะวันออกเฉียงใต้</p>
        <a href="#region" id="learn-more-info">ดูเพิ่มเติม</a>
    </div>
</header>

<section id="region">
    <div class="container-fluid" id="info-region">
        <h1>ศิลปวัฒนธรรมไทยในภาคต่างๆ</h1>
        <p id="info-region-p">ประเทศไทยเป็นแหล่งรวมประชากรและวัฒนธรรมที่หลากหลาย โดยแต่ละภาคของประเทศนี้มีลักษณะประเพณีและวัฒนธรรมที่เป็นเอกลักษณ์ของตนเอง การสืบสานและอนุรักษ์ประเพณีเป็นสิ่งที่มีความสำคัญอย่างยิ่งในชีวิตประจำวันของชาวไทยทั่วประเทศ</p>
    </div>
    <div class="container-fluid">
        <div class="row" id="card-region">
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="https://img.freepik.com/free-vector/thailand-map-poster_1284-12322.jpg?w=900&t=st=1694705221~exp=1694705821~hmac=c9212942d4d03c1cfffc95513322d1ae31bd04639f7565597273b35799c758e2"
                         class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">ภาคเหนือ</h5>
                        <p class="card-text">มีการบูรณะวัฒนธรรมเชิงชาวนาและอารยธรรมที่มีลักษณะเฉพาะตัว
                            ประชากรในภาคนี้มักมีพิธีกรรมทางศาสนาและชีวิตประจำวันที่มีบทบาทสำคัญ
                            ชุดพื้นเมืองและการสวมใส่สิ่งประดับที่มีลวดลายสวยงามเป็นส่วนหนึ่งของประเพณีในภาคเหนือ.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="https://img.freepik.com/free-vector/thailand-map-poster_1284-12322.jpg?w=900&t=st=1694705221~exp=1694705821~hmac=c9212942d4d03c1cfffc95513322d1ae31bd04639f7565597273b35799c758e2"
                         class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">ภาคตะวันออกเฉียงเหนือ</h5>
                        <p class="card-text">มีประเพณีทางวัฒนธรรมพลาดุลิกอันเข้มแข็ง
                            พิธีกรรมทางศาสนาที่เกี่ยวข้องกับที่นอนและการเก็บเกี่ยวมีบทบาทสำคัญ
                            นอกจากนี้ยังมีการใช้เครื่องดนตรีและการรำพระราชดำรัสในพิธีกรรมต่าง ๆ
                            ที่เป็นเอกลักษณ์ของภาคอีสาน</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="https://img.freepik.com/free-vector/thailand-map-poster_1284-12322.jpg?w=900&t=st=1694705221~exp=1694705821~hmac=c9212942d4d03c1cfffc95513322d1ae31bd04639f7565597273b35799c758e2"
                         class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">ภาคกลาง</h5>
                        <p class="card-text">มีการบูรณะวัฒนธรรมทางวัฒนธรรมกลางไทย
                            พิธีกรรมทางศาสนาและศิลปวัฒนธรรมมีความงดงามและสวยงาม
                            สีสันสดใสและลวดลายศิลปะที่คล้ายคลึงกับศิลปะล้านนาเป็นลักษณะเฉพาะของภาคกลาง</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="https://img.freepik.com/free-vector/thailand-map-poster_1284-12322.jpg?w=900&t=st=1694705221~exp=1694705821~hmac=c9212942d4d03c1cfffc95513322d1ae31bd04639f7565597273b35799c758e2"
                         class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">ภาคใต้</h5>
                        <p class="card-text">มีการบูรณะวัฒนธรรมทางวัฒนธรรมมลายู
                            มีพิธีกรรมทางศาสนาและศิลปวัฒนธรรมเชิงเจริญพุทธที่มีลักษณะเฉพาะเจ้าของบ้าน
                            มีเครื่องดนตรีและรำเต้นที่เป็นเอกลักษณ์และเต็มไปด้วยความเครียดและความลึกซึ้งของวัฒนธรรมใต้</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- Link Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>