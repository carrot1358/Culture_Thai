<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate user input (add more validation as needed)
    if ($password !== $confirm_password) {
        $error_message = "Password and confirm password do not match.";
    } else {
        // Connect to the database (replace with your database credentials)
        $conn = new mysqli("localhost", "root", "", "users");

        // Check the database connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to insert user data (replace 'users' with your table name)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $sql = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Registration successful, redirect to the login page or another page
            header("Location: login.html");
            exit();
        } else {
            // Registration failed, display an error message
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
}
?>
