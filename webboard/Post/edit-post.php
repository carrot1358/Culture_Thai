<?php
// Include your database connection code here if not already included.
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "webboard";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<script> alert('Connect DATABASE failed ...'); </script> " . $conn->connect_error);
}

// Check if the user is logged in (assuming you have a user session)
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
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
                echo "<script> alert('แก้ไขโพสต์แล้ว!'); </script>";
                header("Location: ./post.php?id=$post_id");
            } else {
                echo "Error updating post: " . $conn->error;
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
</head>
<body>
<?php
//nav path
$landing_path = "../../index.php";
$homeboard_path = "../webboard-region/board-home.php";
$login_path = "../../Login/login.html";
$register_path = "../../../Register/register.html";

$profile_path = "../../Profile/profile.php";
$my_post_path = "../../Profile/my-post.php";
$logout_path = "../../Logout/logout.php";
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?= $landing_path ?>">ศิลปวัฒนธรรมไทย</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $homeboard_path ?>">Home</a>
                </li>
                <?php

                // Define a custom error handler function to convert warnings to exceptions
                function customErrorHandler($errno, $errstr, $errfile, $errline)
                {
                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
                }

                // Set the custom error handler
                set_error_handler("customErrorHandler");

                try {
                    $user_logged_in = $_SESSION['user_logged_in'];
                    $user_name = $_SESSION['user_name'];
                } catch (ErrorException  $e) {
                    $user_logged_in = false;
                }
                restore_error_handler();
                if ($user_logged_in) {
                    // Display the user's name instead of login and register buttons
                    // Display the user's name as a dropdown

                    echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    echo 'Welcome, ' . $user_name;
                    echo '</a>';
                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    echo '<a class="dropdown-item" href="' . $profile_path . '">Profile</a>';
                    echo '<a class="dropdown-item" href="' . $my_post_path . '">My Posts</a>';
                    echo '<hr style="margin: 2px">';
                    echo '<a class="dropdown-item" href="' . $logout_path . '">Logout</a>';

                    echo '</div>';
                    echo '</li>';
                } else {
                    // Display login and register buttons
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="' . $login_path . '">Login</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="' . $register_path . '">Register</a>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
