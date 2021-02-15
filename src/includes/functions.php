<?php

function cleanString($value = '') {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}

function newUser($fname = '', $lname = '', $login = '', $pass = '') {
    include('connection.php');

    $add_qr = mysqli_query($db, "INSERT INTO `users` (`first_name`, `last_name`, `login`, `password`) VALUES ('$fname', '$lname', '$login', '$pass')");
    if ($add_qr) {
        $select_qr = mysqli_query($db, "SELECT `id` FROM `users` WHERE `login`='$login' AND `password`='$pass'");
        if ($select_qr) {
            $data = mysqli_fetch_assoc($select_qr);
            return $data['id'];
        } else {
            return null;
        }
    } else {
        return null;
    }
}

function authUser($login = '', $pass = '') {
    include('connection.php');

    $select_qr = mysqli_query($db, "SELECT `id` FROM `users` WHERE `login`='$login' AND `password`='$pass'");
    if ($select_qr) {
        $data = mysqli_fetch_assoc($select_qr);
        return $data['id'];
    } else {
        return null;
    }
}

function getUserInfo($id) {
    include('connection.php');

    $select_qr = mysqli_query($db, "SELECT `id`, `photo_url`, `first_name`, `last_name`, `bday`, `city`, `languages`, `about` FROM `users` WHERE `id`='$id'");
    if ($select_qr) {
        $data = mysqli_fetch_assoc($select_qr);
        return $data;
    } else {
        return null;
    }
}

function addPost($aid, $tid, $text = '') {
    include('connection.php');

    $add_qr = mysqli_query($db, "INSERT INTO `wall` (`author_id`, `target_id`, `content`) VALUES ('$aid', '$tid', '$text')");

    if ($add_qr) {
        return true;
    } else {
        return false;
    }
}

function delPost($pid) {
    include('connection.php');

    $del_qr = mysqli_query($db, "DELETE FROM `wall` WHERE `id`='$pid'");

    if ($del_qr) {
        return true;
    } else {
        return false;
    }
}

function likePost($aid, $pid) {
    include('connection.php');

    $post_info_qr = mysqli_query($db, "SELECT `like_count`, `like_list` FROM `wall` WHERE `id`='$pid'");
    $post_data = mysqli_fetch_assoc($post_info_qr);

    $post_current_likes = $post_data['like_count'];
    $new_post_like = $post_current_likes + 1;

    $post_current_like_list = $post_data['like_list'];
    $new_post_like_list = $aid.', '.$post_current_like_list;
    $post_current_like_list_arr = explode(', ', $post_current_like_list);
    if (in_array($aid, $post_current_like_list_arr)) {
        $pattern = '/'.$aid.', /m';
        $new_post_like_list = preg_replace($pattern, '', $post_current_like_list);
        $new_post_like = $post_current_likes - 1;
    }

    $qr = mysqli_query($db, "UPDATE `wall` SET `like_count`='$new_post_like', `like_list`='$new_post_like_list' WHERE `id`=$pid");

    if ($qr) {
        return true;
    } else {
        return false;
    }
}

function getPostInfo($pid) {
    include('connection.php');

    $select_qr = mysqli_query($db, "SELECT `id`, `author_id`, `target_id`, `content`, `like_list` FROM `wall` WHERE `id`='$pid'");
    if ($select_qr) {
        $data = mysqli_fetch_assoc($select_qr);
        return $data;
    } else {
        return null;
    }
}

function getWall($uid) {
    include('connection.php');

    $select_qr = mysqli_query($db, "SELECT `id`, `author_id`, `target_id`, `content`, `like_count`, `like_list` FROM `wall` WHERE `target_id`='$uid'");

    if ($select_qr) {
        $result = mysqli_fetch_row($select_qr);
        return $select_qr;
    } else {
        return null;
    }
}

?>
