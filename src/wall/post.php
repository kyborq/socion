<?php
    session_start();

    require '../includes/connection.php';
    require '../includes/functions.php';

    $my_id = $_SESSION['uid'];
    $qr_id = $_SESSION['target_id'];

    $text = '';

    if (isset($_POST['save'])) {
        $text = $_POST['text'];

        if (!empty($text)) {
            $text = cleanString($text);
            if(addPost($my_id, $qr_id, $text)) {
                header("Location:/profile.php?id=$qr_id");
            }
        }
    }
?>
