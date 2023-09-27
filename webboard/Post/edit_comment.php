<?php
// Assuming you have established a database connection
require '../../server.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the comment_id and edited_comment from the POST data
    $comment_id = $_POST['comment_id'];
    $edited_comment = $_POST['edited_comment'];

    // Check if the user is authorized to edit this comment (you may need to add additional security checks)
    // For example, you can verify if the user has permission to edit the comment.

    // Update the comment in the database
    $sql = "UPDATE comments SET comment = ? WHERE comment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $edited_comment, $comment_id);

    $response = array();
    if ($stmt->execute()) {
        // Comment updated successfully

        $response['status'] = 'success';
        $response['message'] = 'The comment has been updated successfully!';
    } else {
        // Error occurred while updating
        $response['status'] = 'error';
        $response['message'] = 'An error occurred while updating the comment.';
    }
    echo json_encode($response);

    $stmt->close();
}
?>