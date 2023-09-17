<?php
//get user firstname
session_start();
$user_id = $_SESSION['user_id'];
$conn = new mysqli('localhost', 'root', '', 'users');
if ($conn->connect_error) {
    die("<script> alert('Connect DATABASE (users) failed ...'); </script> " . $conn->connect_error);
}
$sql_userfirst_name = "SELECT * FROM user WHERE id = '$user_id'";
$result_userfirst_name = $conn->query($sql_userfirst_name);
$userfirst_name = $result_userfirst_name->fetch_assoc();

$user_first_name = $userfirst_name['first_name'];
$user_id = $userfirst_name['ID'];

//insert post to database
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "webboard";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<script> alert('Connect DATABASE $dbname failed ...'); </script> " . $conn->connect_error);
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $query = "INSERT INTO posts (title, author, content, categorie, timestamp , author_id) VALUES ('$title', '$user_first_name', '$content', '$category', NOW(), '$user_id')";

    if ($conn->query($query) === TRUE) {
        echo "<script> alert('โพสต์แล้ว !!'); </script>";
        header("Location: ../webboard-region/board-home.php");
    } else {
        echo "Error creating post: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
$user_id = $_SESSION['user_id'];
$conn = new mysqli('localhost', 'root', '', 'users');
$sql_userfirst_name = "SELECT first_name FROM user WHERE id = '$user_id'";
$result_userfirst_name = $conn->query($sql_userfirst_name);
$userfirst_name = $result_userfirst_name->fetch_assoc();
$username = $userfirst_name['first_name'];
?>

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
    <h1>Create a New Post</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" class="form-control" id="author" name="author" value="<?=$username?>" disabled>
        </div>
        <div class="form-group">
            <label for="category">หมวดหมู่ :</label>
            <select class="form-control" id="category" name="category">
                <option value="ภาคเหนือ">ภาคเหนือ</option>
                <option value="ภาคตะวันออกเฉียงเหนือ">ภาคตะวันออกเฉียงเหนือ</option>
                <option value="ภาคกลาง">ภาคกลาง</option>
                <option value="ภาคใต้">ภาคใต้</option>
            </select>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
