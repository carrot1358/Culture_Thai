<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Forum Homepage</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include_once('board-query.php');
//nav path
$post_path = "../Post/post.php";
$landing_path = "../../index.php";
$homeboard_path = "./board-home.php";
$login_path = "../../Login/login.html";
$register_path = "../../../Register/register.html";

//category path
$north_path = "./North/board-north.php";
$northeast_path = "./North East/board-northeast.php";
$central_path = "./Central/board-central.php";
$south_path = "./South/board-south.php";

$profile_path = "../../Profile/profile.php";
$my_post_path = "../../Profile/my-post.php";
$logout_path = "../../Logout/logout.php";

$create_post_path = "../Post/create-post.php";
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
                // Check if the user is logged in
                session_start();
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
    <h1>ยินดีต้อนรับสู่เว็บบอร์ด ศิลปวัฒนธรรมไทย</h1>
    <p> เราขอเชิญคุณเข้าร่วมการสนทนาและแลกเปลี่ยนความคิดเห็นเกี่ยวกับศิลปวัฒนธรรมที่หลากหลายและน่าสนใจของประเทศไทย
        ที่นี่คุณจะได้พบกับสมาชิกคนรุ่นใหม่และคนรุ่นก่อนหน้าที่รักในศิลปะและวัฒนธรรมไทยเหมือนคุณเอง

        ร่วมแชร์ประสบการณ์, แนะนำสถานที่ท่องเที่ยวที่น่าสนใจ,
        หรือแบ่งปันความรู้เกี่ยวกับศิลปะและวัฒนธรรมของเราเองได้โดยอิสระ

        ขอให้คุณมีประสบการณ์ที่มีค่าและสนุกสนานในการเป็นส่วนหนึ่งของชุมชนนี้!</p>
    <div class="row">

        <!-- Display  posts -->
        <div class="col-lg-8">

            
            <div class="row">
                <!--Recent posts text-->
                <div class="col"><h2>Recent Posts</h2></div>
                <!--Create post button-->
                <?php if ($user_logged_in) : ?>
                    <div class="col text-right"><a href="<?= $create_post_path ?>"
                                                   class="btn btn-primary">สร้างโพสต์</a></div>
                <?php else : ?>
                    <div class="col text-right"><a href="<?= $login_path ?>"
                                                   class="btn btn-primary">สร้างโพสต์</a></div>
                <?php endif; ?>
            </div>
            <!-- Display recent posts -->
            <?php while ($row = $recentPostsResult->fetch_assoc()) : ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <!-- Inside the while loop for recent posts -->
                        <h3 class="card-title"><a
                                    href="<?= $post_path ?>?id=<?= $row['post_id'] ?>"><?= $row['title'] ?></a></h3>
                        <p class="card-subtitle mb-2 text-muted">โพสต์โดย <strong><?= $row['author'] ?></strong>
                            ในหัวข้อ <em><?= $row['Categorie'] ?></em> เวลา <?= $row['timestamp'] ?></p>
                        <p class="card-text"><?= substr($row['content'], 0, 98) ?>...</p>

                    </div>
                </div>
            <?php endwhile; ?>

            <!-- Display all posts -->
            <h2>All Posts</h2>
            <?php while ($row = $allPostsResult->fetch_assoc()) : ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title"><a
                                    href="<?= $post_path ?>?id=<?= $row['post_id'] ?>"><?= $row['title'] ?></a></h3>
                        <p class="card-subtitle mb-2 text-muted">โพสต์โดย <strong><?= $row['author'] ?></strong>
                            ในหัวข้อ <em><?= $row['Categorie'] ?></em> เวลา <?= $row['timestamp'] ?></p>
                        <p class="card-text"><?= substr($row['content'], 0, 98) ?>...</p>

                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Display categories -->
        <div class="col-lg-4">
            <h2>Categories</h2>
            <ul class="list-group">
                <li class="list-group-item"><a href="<?= $north_path ?>">ภาคเหนือ</a></li>
                <li class="list-group-item"><a href="<?= $northeast_path ?>">ภาคตะวันออกเฉียงเหนือ</a></li>
                <li class="list-group-item"><a href="<?= $central_path ?>">ภาคกลาง</a></li>
                <li class="list-group-item"><a href="<?= $south_path ?>">ภาคใต้</a></li>
            </ul>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

