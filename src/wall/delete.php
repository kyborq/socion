<?php
    session_start();

    require '../includes/connection.php';
    require '../includes/functions.php';

    $my_id = $_SESSION['uid'];
    $qr_id = $_SESSION['target_id'];

    $pid = $_GET['id'];
    $post = getPostInfo($pid);

    if ($post['author_id'] == $my_id) {
        if (!empty($pid)) {
            if(delPost($pid)) {
                header("Location:/profile.php?id=$qr_id");
                $_SESSION['target_id'] = null;
            }
        }
    }
?>
