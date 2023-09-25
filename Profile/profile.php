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
require "../server.php";

$user_logged_in = $_SESSION['user_logged_in'];
$user_id = $_SESSION['user_id'];

$sql_userdetail = "SELECT * FROM users WHERE user_id = '$user_id'";

$result_userdetail = $conn->query($sql_userdetail);
$userdetail = $result_userdetail->fetch_assoc();

$old_username = $userdetail['username'];
$old_email = $userdetail['email'];
$old_phone = $userdetail['phone'];
$old_first_name = $userdetail['first_name'];
$old_last_name = $userdetail['last_name'];
?>

<!--include navbar-->
<?php include ($_SERVER['DOCUMENT_ROOT'] . '\Template\navbar-webboard.php'); ?>


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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
