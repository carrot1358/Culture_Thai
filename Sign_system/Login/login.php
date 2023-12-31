<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f0f0f0;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <?php include ($_SERVER['DOCUMENT_ROOT'] . '\Template\head_include.php'); ?>
</head>
<body>
<div class="container mt-5">
    <div class="login-container">
        <h2 class="text-center">Login</h2>
        <form action="login_query.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="d-grid" style="margin-top: 10px;">
                   <a href="../Register/register.php" class="btn btn-primary">Register</a>

            </div>
        </form>
    </div>
</div>

<?php
if (isset($_SESSION['message'])) {
    if($_SESSION['message'] == "Invalid username or password"){
        echo '<script>';
        echo 'Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "' . $_SESSION['message'] . '",
            showConfirmButton: false,
            timer: 1500
            })';
        echo '</script>';
        unset($_SESSION['message']);
    }else if($_SESSION['message'] == "Login successful."){
        echo '<script>';
        echo 'Swal.fire({
            icon: "success",
            title: "Success",
            text: "' . $_SESSION['message'] . '",
            showConfirmButton: false,
            timer: 1500
            })';
        echo '</script>';
        unset($_SESSION['message']);
        header("refresh:2; url=../../index.php");
    }
}


?>
</body>
</html>
