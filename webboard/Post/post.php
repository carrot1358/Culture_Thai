<?php
require "../../server.php";
session_start();

if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $post_id = mysqli_real_escape_string($conn, $_GET['id']);

    $join_query = "SELECT * FROM posts JOIN users ON posts.author_id = users.user_id WHERE post_id = $post_id";
    $join_result = mysqli_query($conn, $join_query);

    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $result = mysqli_query($conn, $query);

    // Check if the 'id' parameter is set in the URL
    if ($join_result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($join_result);
        // Check if the user is logged in (assuming you have a user session)
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        // Check if the logged-in user is the owner of the post
        $is_owner = ($user_id === $post['author_id']);

        // Query the database to retrieve comments for this post
        $comments_query = "SELECT * FROM comments WHERE post_id = $post_id";
        $comments_result = mysqli_query($conn, $comments_query); ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $post['title'] ?></title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <?php include($_SERVER['DOCUMENT_ROOT'] . '\Template\head_include.php'); ?>
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

        <!--------------------->
        <!-- include navbar --->
        <!--------------------->
        <?php include($_SERVER['DOCUMENT_ROOT'] . '\Template\navbar-webboard.php'); ?>

        <!-------------------------->
        <!--     Java Script     --->
        <!-------------------------->
        <script>
            //--------------------
            // Delete post button
            //--------------------
            function delete_button(post_id) {
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
                            window.location.href = './delete-post.php?id=' + post_id;
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
            //--------------------
            // Edit comment button
            //--------------------
            function openEditForm(existingComment, comment_id) {
                Swal.fire({
                    title: 'Edit Comment' + comment_id,
                    text: 'Edit your comment here',
                    html: '<input id="edit-comment" class="swal2-input" value="' + existingComment + '">',
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    cancelButtonText: 'Cancel',
                    preConfirm: () => {
                        const editedComment = Swal.getPopup().querySelector('#edit-comment').value;

                        // Make an AJAX request to send the edited comment to the server
                        $.ajax({
                            type: 'POST',
                            url: './edit_comment.php', // Replace with the actual server-side script
                            data: {
                                comment_id: comment_id, // Replace with the comment ID
                                edited_comment: editedComment
                            },
                            success: function (response) {
                                // Handle the server's response here (e.g., show a success message)
                                Swal.fire({
                                    title: 'Comment Updated',
                                    icon: 'success',
                                    text: 'The comment has been updated successfully!',
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => {
                                    // Reload the page after the alert is closed
                                    location.reload();
                                });
                            },
                            error: function (xhr, status, error) {
                                // Handle errors (e.g., show an error message)
                                Swal.fire({
                                    title: 'Error',
                                    icon: 'error',
                                    text: 'An error occurred while updating the comment.'
                                });
                            }
                        });
                    }
                });
            }

            //--------------------
            // Delete comment button
            //--------------------
            function DeleteComment(comment_id) {
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
                            window.location.href = './delete-comment.php?id=' + comment_id;
                        }, 1000);
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

        <!--------------------->
        <!---  POST Section --->
        <!--------------------->
        <div class="container mt-5">
            <div class="post-container">
                <div style="float: right">
                    <?php
                    // Display edit and delete buttons if the user is the owner of the post
                    if ($is_owner) {
                        echo '<a href="edit-post.php?id=' . $post_id . '" class="btn btn-primary">Edit</a>';
                        echo '<button type="button" class="btn btn-danger" onclick="delete_button(' . $post_id . ')">Delete</button>';
                    }
                    ?>
                </div>
                <h1><?= $post['title'] ?></h1>
                <p class="text-muted">Posted by <?= $post['first_name'] ?> on <?= $post['timestamp'] ?></p>
                <p><?= $post['content'] ?></p>

            </div>

            <!--------------------->
            <!-- Comment Section -->
            <!--------------------->
            <div class="mt-4">
                <h2>Comments</h2>
                <?php
                while ($comment = mysqli_fetch_assoc($comments_result)) {
                    echo '<div class="card mt-3">';
                    echo '<div class="card-body">';

                    // Check if the current user is the owner of the comment
                    $isCurrentUserOwner = false; // Assume the current user is not the owner
                    if (isset($_SESSION['user_id']) && $comment['user_id'] == $_SESSION['user_id']) {
                        $isCurrentUserOwner = true; // Set to true if the user owns the comment
                    }

                    echo '<div style="float: right;">'; // Align buttons to the right
                    // Display the edit button if the user owns the comment
                    if ($isCurrentUserOwner) {
                        // Use SweetAlert2 to trigger the edit form
                        if ($isCurrentUserOwner) {
                            // Use SweetAlert2 to trigger the edit form
                            echo '<button class="btn btn-primary btn-sm" type="button" onclick="openEditForm(\'' . $comment['comment'] . '\', \'' . $comment['comment_id'] . '\')">Edit</button>';
                            echo '<button class="btn btn-danger btn-sm" type="button" onclick="DeleteComment(\'' . $comment['comment_id'] . '\')">Delete</button>';
                        }

                    }

                    // Display the delete button if the user owns the comment
                    if ($isCurrentUserOwner) {

                    }
                    echo '</div>';

                    $sql_userdetail = "SELECT * FROM users WHERE user_id = '{$comment['user_id']}'";
                    $result_userdetail = $conn->query($sql_userdetail);
                    $result_userdetail = $result_userdetail->fetch_assoc();

                    echo '<h5 class="card-title" style="margin-bottom: 0;">' . $result_userdetail['first_name'] . '</h5>';
                    echo '<p class="text-muted">' . $comment['timestamp'] . '</p>';
                    echo '<p class="card-text">' . $comment['comment'] . '</p>';

                    echo '</div>';
                    echo '</div>';
                }
                ?>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="post" action="add-comment.php">

                        <input type="hidden" name="post_id" value="<?= $post_id ?>">
                        <div class="form-group mt-3">
                            <label for="comment">Add a Comment:</label>
                            <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                <?php else: ?>
                    <div class="form-group mt-3">
                        <label for="comment">Add a Comment:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="0" disabled></textarea>
                    </div><a href="<?= $login_path ?>">
                        <button class="btn btn-primary">Login</button>
                    </a>

                <?php endif; ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
