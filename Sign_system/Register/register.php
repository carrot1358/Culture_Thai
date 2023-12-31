<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '\Template\head_include.php'); ?>
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f0f0f0;
        }

        .registration-container {
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

<div class="container mt-5">
    <div class="registration-container">
        <h2 class="text-center">Register</h2>
        <form action="register_query.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <div class="input-group">
                    <span class="input-group-text">+66</span>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
            </div>



            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="birthday" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</div>

<?php

if (isset($_SESSION['message'])) {
    if($_SESSION['message'] == "Username or email is already in use."){
        echo '<script>';
        echo 'Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "' . $_SESSION['message'] . '",
            showConfirmButton: false,
            timer: 1000
            })';
        echo '</script>';
        unset($_SESSION['message']);
    }else if($_SESSION['message'] == "Registration successful."){
        echo '<script>';
        echo 'Swal.fire({
            icon: "success",
            title: "Success",
            text: "' . $_SESSION['message'] . '",
            showConfirmButton: false,
            timer: 1000
            })';
        echo '</script>';
        unset($_SESSION['message']);
        header("refresh:1; url=../Login/login.php");
    }
}
?>

<script>
    // JavaScript to handle phone number input validation
    document.getElementById("phone").addEventListener("input", function () {
        // Remove all non-digit characters
        const phoneNumber = this.value.replace(/\D/g, "");

        // Limit the phone number to 9 digits
        const maxDigits = 9;
        if (phoneNumber.length > maxDigits) {
            this.value = phoneNumber.slice(0, maxDigits);
        } else {
            this.value = phoneNumber;
        }
    });
</script>


</body>
</html>
