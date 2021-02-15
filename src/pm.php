<?php
    require 'includes/header.php';

    $qr = mysqli_query($db, "SELECT `author_id`, `target_id` FROM `messages` WHERE `target_id`='$my_id' GROUP BY `author_id`");
    $myqr = mysqli_query($db, "SELECT `author_id`, `target_id` FROM `messages` WHERE `author_id`='$my_id' GROUP BY `target_id`");

    $target = $_GET['send'];
?>

<div class="narrow-collumn">
    <div class="page-block">
        <h3 class="page-block-title">Диалоги</h3>

        <?php
        while ($res = mysqli_fetch_array($qr)) {
            $usr = getUserInfo($res['author_id']);
            ?>
            <a class="dialogue-link" href="/pm.php?send=<?php echo $usr['id']; ?>">
                <img class="dialogue-photo" src="<?php echo $usr['photo_url']; ?>">
                <div class="dialogue-name"><span class="dialogue-name-content"><?php echo $usr['first_name'].' '.$usr['last_name']; ?></span></div>
            </a>
        <?php } ?>

        <?php
        while ($res2 = mysqli_fetch_array($myqr)) {
            $usr2 = getUserInfo($res2['target_id']);
            ?>
            <a class="dialogue-link" href="/pm.php?send=<?php echo $usr2['id']; ?>">
                <img class="dialogue-photo" src="<?php echo $usr2['photo_url']; ?>">
                <div class="dialogue-name"><span class="dialogue-name-content"><?php echo $usr2['first_name'].' '.$usr2['last_name']; ?></span></div>
            </a>
        <?php } ?>
    </div>
</div>

<div class="wide-collumn">
    <div class="page-block">
        <?php if (isset($target)) { ?>
            <?php $usr = getUserInfo($target); ?>
            <h3 class="page-block-title"><?php echo $usr['first_name'].' '.$usr['last_name']; ?></h3>
        <?php } else { ?>
            <h3 class="page-block-title">Сообщения</h3>
        <?php } ?>

        <?php if (isset($target)) { ?>
            <form class="message-form" action="" method="post">
                <textarea class="field text-field" name="text"></textarea>
                <input class="button" type="submit" name="send" value="Отправить">
            </form>
        <?php } ?>

        <div class="message-wall">
            <?php
            $target = $_GET['send'];
            $qr = mysqli_query($db, "SELECT * FROM `messages` WHERE `target_id`='$my_id' AND `author_id`='$target' OR `target_id`='$target' AND `author_id`='$my_id' ORDER BY `id` DESC");

            while($res = mysqli_fetch_array($qr)) {
                $usr_m = getUserInfo($res['author_id']);
            ?>
                <div class="message-row">
                    <img class="message-photo" src="<?php echo $usr_m['photo_url']; ?>" alt="">

                    <div class="message-info">
                        <a class="message-author" href="/profile.php?id=<?php echo $usr_m['id']; ?>"><?php echo $usr_m['first_name'].' '.$usr_m['last_name']; ?></a>
                        <div class="message-content"><?php echo $res['content']; ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php

        if (isset($_POST['send'])) {
            $text = $_POST['text'];
            if (isset($text)) {
                $qr = mysqli_query($db, "INSERT INTO `messages` (`author_id`, `target_id`, `content`) VALUES ('$my_id', '$target', '$text')");

                if ($qr) {
                    $success = true;
                } else {
                    $success = false;
                }
            }
        }

        ?>

        <?php if ($success) { ?>
            <div class="success">
                <?php echo "Сообщение отправлено"; ?>
            </div>
        <?php } ?>
    </div>
</div>
