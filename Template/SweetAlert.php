<?php
session_start();
$send = $_SESSION['send'];
$icon = $_SESSION['icon'];
$title = $_SESSION['title'];
$text = $_SESSION['text'];
$showConfirmButton = $_SESSION['showConfirmButton'];
$timer = $_SESSION['timer'];

if (isset($_SESSION['send'])) {
        echo '<script>';
        echo 'Swal.fire({
            icon: "'.$_SESSION['icon'].'",
            title: "'.$_SESSION['title'].'",
            text: "' .$_SESSION['text'] . '",
            showConfirmButton: '.$_SESSION['showConfirmButton'].',
            timer: '.$_SESSION['timer'].'
            })';
        echo '</script>';
        unset($_SESSION['send'], $_SESSION['icon'], $_SESSION['title'], $_SESSION['text'], $_SESSION['showConfirmButton'], $_SESSION['timer']);
}
?>