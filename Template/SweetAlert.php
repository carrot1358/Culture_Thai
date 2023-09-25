<?php
if (isset($_SESSION['message'])) {
    if($_SESSION['message'] == "Invalid username or password"){
        echo '<script>';
        echo 'Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "' . $_SESSION['message'] . '",
            showConfirmButton: false,
            timer: 1500
            })';
        echo '</script>';
        unset($_SESSION['message']);
    }else if($_SESSION['message'] == "Login successful."){
        echo '<script>';
        echo 'Swal.fire({
            icon: "success",
            title: "Success",
            text: "' . $_SESSION['message'] . '",
            showConfirmButton: false,
            timer: 1500
            })';
        echo '</script>';
        unset($_SESSION['message']);
        header("refresh:2; url=../../index.php");
    }
}
?>