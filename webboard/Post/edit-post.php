<?php
// Include your database connection code here if not already included.
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
    $post_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query the database to retrieve the post data
    $query = "SELECT * FROM posts WHERE post_id = '$post_id' AND author_id = '{$_SESSION['user_id']}'";
    $result = mysqli_query($conn, $query);

    // Check if the post exists and belongs to the logged-in user
    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve and sanitize updated post data
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $content = mysqli_real_escape_string($conn, $_POST['content']);

            // Update the post in the database
            $update_query = "UPDATE posts SET title = '$title', content = '$content' WHERE post_id = '$post_id'";

            if ($conn->query($update_query) === TRUE) {
                $_SESSION['message'] = "Post updated successfully.";
                header("refresh:1; url=./post.php?id=$post_id");
            } else {
                $_SESSION['message'] = "Error updating post: " . $conn->error;
                header("refresh:1; url=./post.php?id=$post_id");
            }
        }
    } else {
        echo "You don't have permission to edit this post.";
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
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '\Template\head_include.php'); ?>
</head>
<body>


<!-------------------->
<!-- include navbar -->
<!-------------------->
<?php include ($_SERVER['DOCUMENT_ROOT'] . '\Template\navbar-webboard.php'); ?>

<!-------------------->
<!-- Editor section -->
<!-------------------->
<div class="container mt-5">
    <h1>Edit Post</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$post_id"; ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $post['title'] ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" rows="4" required><?= $post['content'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>

<!-------------------->
<!--  Sweet Alert   -->
<!-------------------->
<?php
if (isset($_SESSION['message'])) {
    if($_SESSION['message'] == "Error updating post: " . $conn->error){
        echo '<script>';
        echo 'Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "' . $_SESSION['message'] . '",
            showConfirmButton: false,
            timer: 1500
            })';
        echo '</script>';
        unset($_SESSION['message']);
    }else if($_SESSION['message'] == "Post updated successfully."){
        echo '<script>';
        echo 'Swal.fire({
            icon: "success",
            title: "Success",
            text: "' . $_SESSION['message'] . '",
            showConfirmButton: false,
            timer: 1500
            })';
        echo '</script>';
        unset($_SESSION['message']);
    }
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
