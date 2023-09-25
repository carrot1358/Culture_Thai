<?php
// Check if the form is submitted
session_start();
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Connect to the database (replace with your database credentials)
    require "../server.php";

    // Update user information in the database
    $sql = "UPDATE users SET email = '$email', phone = '$phone', first_name = '$first_name', last_name = '$last_name' WHERE user_id = $user_id"; // Assuming 'id' is the user's unique identifier

    if ($conn->query($sql) === TRUE) {
        // Profile update successful
        header("Location: ../index.php");
        exit();
    } else {
        // Profile update failed
        $error_message = "Error updating profile: " . $conn->error;
        echo "<script>alert('$error_message');</script>";
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the profile page if the form was not submitted through a POST request
    echo "<script>alert('Error contact admin');</script>";
    header("Location: profile.php");
    exit();
}
