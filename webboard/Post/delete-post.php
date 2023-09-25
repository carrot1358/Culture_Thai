<?php
require "../../server.php";

// Check if the user is logged in (assuming you have a user session)
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_query.php"); // Redirect to the login page if not logged in
    exit;
}

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $post_id = $_GET['id'];

    // Query the database to retrieve the post data
    $query = "SELECT * FROM posts WHERE post_id = '$post_id' AND author_id = '{$_SESSION['user_id']}'";
    $result = mysqli_query($conn, $query);

    // Check if the post exists and belongs to the logged-in user
    if ($result && mysqli_num_rows($result) > 0) {
        // Delete the post from the database
        $delete_query = "DELETE FROM posts WHERE post_id = '$post_id'";
        $delete_comment_query = "DELETE FROM comments WHERE post_id = '$post_id'";

        if ($conn->query($delete_comment_query) == TRUE) {
            echo "Comment deleted successfully.";
            if ($conn->query($delete_query) == TRUE) {
                echo "Post deleted successfully.";
                header("Location: ../../Profile/my-post.php");
            }
        }else {
            echo "Error deleting post: " . $conn->error;
        }
    } else {
        echo "You don't have permission to delete this post.";
    }
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php //header("Location: ../../Profile/my-post.php"); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
