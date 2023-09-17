<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "webboard";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve recent posts
$recentPostsQuery = "SELECT * FROM posts ORDER BY timestamp DESC LIMIT 2";
$recentPostsResult = $conn->query($recentPostsQuery);

// Query to retrieve all posts
$allPostsQuery = "SELECT * FROM posts ORDER BY timestamp DESC";
$allPostsResult = $conn->query($allPostsQuery);
?>
