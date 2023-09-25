<?php
// Path: Template/navbar-webboard.php
//POST path
$add_comment_path = "/Culture_Thai/webboard/Post/add-comment.php";
$create_post_path = "/Culture_Thai/webboard/Post/create-post.php";
$delete_post_path = "/Culture_Thai/webboard/Post/delete-post.php";
$edit_post_path = "/Culture_Thai/webboard/Post/edit-post.php";
$post_path = "/Culture_Thai/webboard/Post/post.php";
//Profile path
$my_post_path = "/Culture_Thai/Profile/my-post.php";
$profile_path = "/Culture_Thai/Profile/profile.php";
//Landing path
$landing_path = "/Culture_Thai/index.php";
//Webboard path
$homeboard_path = "/Culture_Thai/webboard/board-home.php";
//Login path
$login_path = "/Culture_Thai/Sign_system/Login/login.php";
$register_path = "/Culture_Thai/Sign_system/Register/register.php";
$logout_path = "/Culture_Thai/Sign_system/Logout/logout.php";
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?= $landing_path ?>">ศิลปวัฒนธรรมไทย</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $homeboard_path ?>">Home</a>
                </li>
                <?php
                // Check if the user is logged in
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

                    echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    echo 'Welcome, ' . $user_name;
                    echo '</a>';
                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    echo '<a class="dropdown-item" href="' . $profile_path . '">Profile</a>';
                    echo '<a class="dropdown-item" href="' . $my_post_path . '">My Posts</a>';
                    echo '<hr style="margin: 2px">';
                    echo '<a class="dropdown-item" href="' . $logout_path . '">Logout</a>';

                    echo '</div>';
                    echo '</li>';
                } else {
                    // Display login and register buttons
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="' . $login_path . '">Login</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="' . $register_path . '">Register</a>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
