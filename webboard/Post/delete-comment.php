<?php
// Include your database connection code here, e.g., database.php
// Example:
// require_once('database.php');

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize and validate the 'id' parameter
    $comment_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if ($comment_id === false) {
        // Handle invalid 'id' parameter (e.g., redirect or display an error)
        echo "Invalid comment ID";
        exit;
    }

    require '../../server.php';

    // Get the post_id of the comment
    $sql = "SELECT post_id FROM comments WHERE comment_id = $comment_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $post_id = $row['post_id'];

    // Prepare a DELETE statement
    $sql = "DELETE FROM comments WHERE comment_id = ?";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        // Handle the SQL statement preparation error
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    // Bind the 'id' parameter to the prepared statement
    $stmt->bind_param("i", $comment_id);

    // Execute the statement
    if ($stmt->execute() === true) {
        // Comment deleted successfully
        header("Location: ../Post/post.php?id=$post_id");
        echo "Comment deleted successfully";
    } else {
        // Handle the deletion error
        echo "Error deleting comment: " . $stmt->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $db->close();
} else {
    // Handle the case when 'id' parameter is not set in the URL
    echo "Comment ID not provided";
}
?>
