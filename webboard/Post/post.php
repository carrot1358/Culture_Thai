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

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $post_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query the database to retrieve the post data
    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $result = mysqli_query($conn, $query);

    // Check if the 'id' parameter is set in the URL
    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
        // Check if the user is logged in (assuming you have a user session)
        session_start();
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        // Check if the logged-in user is the owner of the post
        $is_owner = ($user_id === $post['author_id']);

        // Query the database to retrieve comments for this post
        $comments_query = "SELECT * FROM comments WHERE post_id = $post_id";
        $comments_result = mysqli_query($conn, $comments_query);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $post['title'] ?></title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>
                /* Add your custom CSS styles here */
                body {
                    background-color: #f8f9fa;
                    padding: 20px;
                }
                .post-container {
                    background-color: #fff;
                    border-radius: 10px;
                    padding: 20px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
            </style>
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
            <div class="post-container">
                <h1><?= $post['title'] ?></h1>
                <p class="text-muted">Posted by <?= $post['author'] ?> on <?= $post['timestamp'] ?></p>
                <p><?= $post['content'] ?></p>
                <?php
                // Display edit and delete buttons if the user is the owner of the post
                if ($is_owner) {
                    echo '<a href="edit-post.php?id=' . $post_id . '" class="btn btn-primary">Edit</a>';
                    echo '<a href="delete-post.php?id=' . $post_id . '" class="btn btn-danger">Delete</a>';
                }
                ?>
            </div>

            <!-- Comment Section -->
            <div class="mt-4">
                <h2>Comments</h2>
                <?php
                while ($comment = mysqli_fetch_assoc($comments_result)) {
                    echo '<div class="card mt-3">';
                    echo '<div class="card-body">';
                    $conn2 = new mysqli("localhost", "root", "", "users");
                    $sql_userdetail = "SELECT * FROM user WHERE ID = '{$comment['user_id']}'";
                    $result_userdetail = $conn2->query($sql_userdetail);
                    $result_userdetail = $result_userdetail->fetch_assoc();
                    echo '<h5 class="card-title" style="margin-bottom: 0;">' . $result_userdetail['first_name'] . '</h5>';
                    echo '<p class="text-muted">'  .$comment['timestamp'] . '</p>';
                    echo '<p class="card-text">' . $comment['comment'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
                <form method="post" action="add-comment.php">
                    <input type="hidden" name="post_id" value="<?= $post_id ?>">
                    <div class="form-group mt-3">
                        <label for="comment">Add a Comment:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        echo "Post not found.";
    }
} else {
    echo "Invalid request.";
}
?>
