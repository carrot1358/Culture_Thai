<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Forum Homepage</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="../assets/css/webboard.css" rel="stylesheet">
    <?php include($_SERVER['DOCUMENT_ROOT'] . "\Template\head_include.php"); ?>
<style>
    body{
        font-family: 'Noto Sans Thai', sans-serif;
        font-weight: 300;
    }
    .welcome{
        margin-bottom: 4rem;
    }
</style>
</head>
<body>
<?php
session_start();
include('board-query.php');
include($_SERVER['DOCUMENT_ROOT'].'\Template\navbar-webboard.php');
?>


<div class="container mt-5">
    <div class="welcome">
        <h1>ยินดีต้อนรับสู่เว็บบอร์ด ประเพณีลอยกระทง</h1>
        <p> ร่วมสนทนาและแบ่งปันเรื่องราวที่เกี่ยวกับประเพณีลอยกระทงในประเทศไทยที่นี่ครับ/ค่ะ!</p>
    </div>
    
    <div class="row">

        <!-------------------->
        <!-- Display  posts -->
        <!-------------------->
        <div class="col-lg-8">
            <div class="row">
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

            <!-------------------------->
            <!-- Display recent posts -->
            <!-------------------------->
            <?php while ($row = $recent_result->fetch_assoc()) : ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <!-- Inside the while loop for recent posts -->
                        <h3 class="card-title"><a
                                    href="<?= $post_path ?>?id=<?= $row['post_id'] ?>"><?= $row['title'] ?></a></h3>
                        <p class="card-subtitle mb-2 text-muted">โพสต์โดย <strong><?= $row['first_name'] ?></strong>
                            ในหัวข้อ <em><?= $row['Categorie'] ?></em> เวลา <?= $row['timestamp'] ?></p>
                        <p class="card-text"><?= substr($row['content'], 0, 98) ?>...</p>

                    </div>
                </div>
            <?php endwhile; ?>

            <!----------------------->
            <!-- Display all posts -->
            <!----------------------->
            <h2>All Posts</h2>
            <?php while ($row = $All_result->fetch_assoc()) : ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title"><a
                                    href="<?= $post_path ?>?id=<?= $row['post_id'] ?>"><?= $row['title'] ?></a></h3>
                        <p class="card-subtitle mb-2 text-muted">โพสต์โดย <strong><?= $row['first_name'] ?></strong>
                            ในหัวข้อ <em><?= $row['Categorie'] ?></em> เวลา <?= $row['timestamp'] ?></p>
                        <p class="card-text"><?= substr($row['content'], 0, 98) ?>...</p>

                    </div>
                </div>
            <?php endwhile; ?>
        </div>


        <!------------------------>
        <!-- Display statistics -->
        <!------------------------>
        <div class="col-lg-4">
            <div class="Statistics">
                <h4>Statistics</h4>
                <ul>
                    <li>Total Comments: <?php echo $comment_count; ?></li>
                    <li>Total Posts: <?php echo $post_count; ?></li>
                    <li>Total Users: <?php echo $user_count; ?></li>
                </ul>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../assets/js/webboard.js"></script>
</body>
</html>

