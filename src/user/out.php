<?php
    session_start();

    $_SESSION['logged'] = null;
    $_SESSION['registered'] = null;
    $_SESSION['target_id'] = null;
    $_SESSION['uid'] = null;

    header('Location:/index.php')
?>
