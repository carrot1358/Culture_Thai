<?php
require "../../server.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $post_id = mysqli_real_escape_string($conn, $_POST['post_id']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    // Check if the user is logged in (assuming you have a user session)
    session_start();
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Insert the comment into the database
    $insert_query = "INSERT INTO comments (post_id, user_id, comment , timestamp) VALUES ('$post_id', '$user_id', '$comment' , NOW())";

    if ($conn->query($insert_query) === TRUE) {
        // Redirect back to the post page after adding the comment
        header("Location: post.php?id=$post_id");
        exit;
    } else {
        echo "Error adding comment: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
