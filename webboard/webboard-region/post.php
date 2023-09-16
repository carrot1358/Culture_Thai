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
    //end connect database

if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $post_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query the database to retrieve the post data
    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $result = mysqli_query($conn, $query);


    // Check if the 'id' parameter is set in the URL
    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
        // Display the post content
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
        <div class="container mt-5">
            <div class="post-container">
                <h1><?= $post['title'] ?></h1>
                <p class="text-muted">Posted by <?= $post['author'] ?> on <?= $post['timestamp'] ?></p>
                <p><?= $post['content'] ?></p>
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