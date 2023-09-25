<?php

session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../../server.php";
    // Retrieve user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to retrieve user data (replace 'users' with your table name)
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if a matching user is found
    if ($result->num_rows === 1) {
        // Authentication successful, redirect to the dashboard or another page
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_name'] = $username;
        $_SESSION['user_id'] = $result->fetch_assoc()['user_id'];
        //$_SESSION['user_firstname'] = $result->fetch_assoc()['first_name'];
        $_SESSION['message'] = "Login successful.";
        header("refresh:0; url=./login.php");
        exit();
    } else {
        // Authentication failed, display an error message
        $_SESSION['message'] = "Invalid username or password";
        header("refresh:0; url=./login.php");
    }

    // Close the database connection
    $conn->close();
}
?>
