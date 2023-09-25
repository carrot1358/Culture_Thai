<?php
// Path: Template/navbar-landing.php
$history_path = "#services";
$advice_path = "#advice-section";
$howto_path = "#howtomake-section";
$travel_path = "#Travel-section";
$webboard_path = "/Culture_Thai/webboard/board-home.php";


$loginpath = "/Culture_Thai/Sign_system/Login/login.php";
$register_path = "/Culture_Thai/Sign_system/Register/register.php";
$logout_path = "/Culture_Thai/Sign_system/Logout/logout.php";

$profile_path = "/Culture_Thai/Profile/profile.php";
$my_post_path = "/Culture_Thai/Profile/my-post.php";
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary" id="nav-bar">
    <div class="container-fluid">
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
                    <a class="nav-link" href="<?=$history_path?>">ประวัติ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$advice_path?>">คำแนะนำ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$howto_path?>">วิธีทำกระทง</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$travel_path?>">แหล่งท่องเที่ยว</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$webboard_path?>"><b>เว็บบอร์ด</b></a>
                </li>
            </ul>

        </div>
        <div class="d-flex">
            <?php
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