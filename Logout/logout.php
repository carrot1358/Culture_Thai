<?php
session_start();
// Check if the user is logged in
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    // Destroy the session
    session_destroy();

    // Redirect the user to the login page
    header("Location: ../index.php");
    exit();
} else {
    // If the user is not logged in
    echo '<script>alert("You are not logged in.")</script>';
    header("Location: ../index.php");
}
?>
