<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f0f0f0;
        }
        .profile-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<?php
session_start();

$user_logged_in = $_SESSION['user_logged_in'];
$user_id = $_SESSION['user_id'];

$conn = new mysqli("localhost", "root", "", "users");
$sql_userdetail = "SELECT * FROM user WHERE id = '$user_id'";

$result_userdetail = $conn->query($sql_userdetail);
$userdetail = $result_userdetail->fetch_assoc();

$old_username = $userdetail['username'];
$old_email = $userdetail['email'];
$old_phone = $userdetail['phone'];
$old_first_name = $userdetail['first_name'];
$old_last_name = $userdetail['last_name'];
?>
<?php
//nav path
$landing_path = "../index.php";
$homeboard_path = "../webboard/webboard-region/board-home.php";
$login_path = "../Login/login.html";
$register_path = "../Register/register.html";

$profile_path = "./profile.php";
$my_post_path = "./my-post.php";
$logout_path = "./logout.php";
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?= $landing_path ?>">ศิลปวัฒนธรรมไทย</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $homeboard_path ?>">Home</a>
                </li>
                <?php

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
<div class="container mt-5">
    <div class="profile-container">
        <h2 class="text-center"><?=$old_username?>'s Profile</h2>
        <form action="update_profile.php" method="POST" style="margin-top: 2rem;">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?=$old_username?>" disabled>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?=$old_email?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <div class="input-group">
                    <span class="input-group-text">+66</span>
                    <input type="tel" class="form-control" id="phone" name="phone" value="<?=$old_phone?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?=$old_first_name?>" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?=$old_last_name?>">
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Birthday</label>
                <input type="text" class="form-control" id="birthday" name="birthday" value="1990-01-01" readonly disabled>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
