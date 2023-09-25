<?php
session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthday = $_POST['birthday'];
    $confirm_password = $_POST['confirm_password'];

    // Validate user input (add more validation as needed)
    if ($password !== $confirm_password) {
        $error_message = "Username or email is already in use.";
        $_SESSION['message'] = $error_message;
        header("refresh:0; url=./register.php");
    } else {
        require ($_SERVER['DOCUMENT_ROOT'] . "\server.php");

        // Check if username or email already exists
        $check_existing = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $existing_result = $conn->query($check_existing);

        if ($existing_result->num_rows > 0) {
            // Username or email is already in use
            $error_message = "Username or email is already in use.";
            $_SESSION['message'] = $error_message;
            header("refresh:0; url=./register.php");

        } else {
            // Query to insert user data
            $insert_sql = "INSERT INTO users (username, password , email , phone , first_name, last_name, birthday) 
                    VALUES ('$username', '$password', '$email', '$phone', '$first_name', '$last_name', '$birthday')";

            // Execute the query
            if ($conn->query($insert_sql) === TRUE) {
                // Registration successful, redirect to the login page or another page
                $message = "Registration successful.";
                $_SESSION['message'] = $message;
                header("refresh:0; url=./register.php");
                exit();
            } else {
                // Registration failed, display an error message
                $error_message = "Error: " . $insert_sql . "<br>" . $conn->error;
                echo $error_message;
            }
        }

        // Close the database connection
        $conn->close();
    }
}
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
?>
