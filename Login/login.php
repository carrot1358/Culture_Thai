<?php
session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database (replace with your database credentials)
    $conn = new mysqli("localhost", "root", "", "users");

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to retrieve user data (replace 'users' with your table name)
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if a matching user is found
    if ($result->num_rows === 1) {
        // Authentication successful, redirect to the dashboard or another page
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_name'] = $username;
        $_SESSION['user_id'] = $result->fetch_assoc()['ID'];
        $_SESSION['user_firstname'] = $result->fetch_assoc()['first_name'];
        header("Location: ../index.php");
        exit();
    } else {
        // Authentication failed, display an error message
        $error_message = "Invalid username or password";
    }

    // Close the database connection
    $conn->close();
}
?>
