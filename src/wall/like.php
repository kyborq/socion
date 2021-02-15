<?php
    session_start();

    require '../includes/connection.php';
    require '../includes/functions.php';

    $my_id = $_SESSION['uid'];
    $qr_id = $_SESSION['target_id'];

    $pid = $_GET['post'];

    if (!empty($pid)) {
        if(likePost($my_id, $pid)) {
            header("Location:/profile.php?id=$qr_id");
            $_SESSION['target_id'] = null;
        }
    }
?>
