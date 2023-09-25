<?php
require "../server.php";



$joinrecentwithuser = "SELECT * FROM posts INNER JOIN users ON posts.author_id = users.user_id ORDER BY timestamp DESC LIMIT 2";
$recent_result = $conn->query($joinrecentwithuser);

$joinpostwithuser = "SELECT * FROM posts INNER JOIN users ON posts.author_id = users.user_id ORDER BY timestamp DESC";
$All_result = $conn->query($joinpostwithuser);


// Count all comments
$sql_comments = "SELECT COUNT(*) AS comment_count FROM comments";
$result_comments = $conn->query($sql_comments);
$row_comments = $result_comments->fetch_assoc();
$comment_count = $row_comments['comment_count'];

// Count all posts
$sql_posts = "SELECT COUNT(*) AS post_count FROM posts";
$result_posts = $conn->query($sql_posts);
$row_posts = $result_posts->fetch_assoc();
$post_count = $row_posts['post_count'];

// Count all users
$sql_users = "SELECT COUNT(*) AS user_count FROM users";
$result_users = $conn->query($sql_users);
$row_users = $result_users->fetch_assoc();
$user_count = $row_users['user_count'];

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();

?>
