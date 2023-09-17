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

    // Assuming you have some form of user authentication or session management, retrieve the user's ID
    // For example, if you're using sessions, you might have something like this:
    // $user_id = $_SESSION['user_id'];

    // Connect to the database (replace with your database credentials)
    $conn = new mysqli("localhost", "root", "", "users");

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update user information in the database
    $sql = "UPDATE user SET email = '$email', phone = '$phone', first_name = '$first_name', last_name = '$last_name' WHERE id = $user_id"; // Assuming 'id' is the user's unique identifier

    if ($conn->query($sql) === TRUE) {
        // Profile update successful, you can redirect back to the profile page or show a success message
        header("Location: ../index.php");
        exit();
    } else {
        // Profile update failed, display an error message
        $error_message = "Error updating profile: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the profile page if the form was not submitted through a POST request
    echo "<script>alert('Error contact admin');</script>";
    header("Location: profile.php");
    exit();
}
