<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '\Template\head_include.php'); ?>
</head>
<body>

<!------------------------------->
<!-- check logged in, query post-->
<!------------------------------->
<?php
//connect to database
require "../server.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_query.php"); // Redirect to the login page if not logged in
    exit;
}

$user_id = $_SESSION['user_id'];
// Query the database to retrieve posts created by the logged-in user
$query = "SELECT * FROM posts WHERE author_id = '$user_id'";
$result = mysqli_query($conn, $query);
?>

<!-------------------->
<!-- Include Navbar -->
<!-------------------->
<?php include($_SERVER['DOCUMENT_ROOT'] . '\Template\navbar-webboard.php'); ?>

<!-------------------------->
<!-- Delete postbutton.js --->
<!--------------------------->
<script>
    function delete_button(row_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',

            confirmButtonText: 'Yes, delete it!'
        }).then((result,) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1000

                })
                setTimeout(function () {
                    window.location.href = '../webboard/Post/delete-post.php?id=' + row_id;
                }, 2000); // 2000 milliseconds = 2 seconds
            } else {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'Your imaginary file is safe :)',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        })
    }
</script>
<div class="container mt-5">
    <h1>My Posts</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ชื่อเรื่อง</th>
            <th>หมวดหมู่</th>
            <th>เวลาที่สร้าง</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><a href="<?= $post_path ?>?id=<?= $row['post_id'] ?>"><?= $row['title'] ?></a></td>
                <td><?= $row['Categorie'] ?></td>
                <td><?= $row['timestamp'] ?></td>
                <td><a class="btn btn-warning" href="../webboard/Post/edit-post.php?id=<?= $row['post_id'] ?>">Edit</a>
                    |
                    <button type="button" class="btn btn-danger" onclick="delete_button(<?= $row['post_id'] ?>)">
                        Delete
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <a href="../webboard/Post/create-post.php" class="btn btn-primary">Create New Post</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
