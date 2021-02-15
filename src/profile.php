<?php
    require 'includes/header.php';

    $qr_id = $_GET['id'];
    if (empty($qr_id)) {
        $qr_id = $my_id;
    }

    $qr_data = getUserInfo($qr_id);

    $_SESSION['target_id'] = $qr_id;
?>

<div class="narrow-collumn profile-side">
    <div class="page-block">
        <div class="page-photo">
            <img src="<?php echo $qr_data['photo_url']; ?>" alt="">
        </div>

        <?php if ($qr_id == $my_id) { ?>
            <a class="page-action" href="/user/edit.php">Редактировать</a>
            <a class="page-action nooo" href="/user/out.php">Выйти</a>
        <?php } else { ?>
            <a class="page-action doit" href="/pm.php?send=<?php echo $qr_data['id']; ?>">Сообщение</a>
        <?php } ?>
    </div>

    <?php require '/includes/footer.php'; ?>
</div>

<div class="wide-collumn">
    <div class="page-block">
        <h2 class="page-name"><?php echo $qr_data['first_name'].' '.$qr_data['last_name']; ?></h2>

        <div class="short-info">
            <div class="info-row">
                <div class="label">День рождения: </div>
                <div class="labeled">
                    <?php
                    if (!empty($qr_data['bday'])) { echo $qr_data['bday']; } else { echo "<span class='notcompl'>Информация не заполнена</span>"; }
                    ?>
                </div>
            </div>
        </div>

        <div class="short-info">
            <div class="info-row">
                <div class="label">Родной город: </div>
                <div class="labeled"><?php if (!empty($qr_data['city'])) { echo $qr_data['city']; } else { echo "<span class='notcompl'>Информация не заполнена</span>"; } ?></div>
            </div>
        </div>

        <div class="short-info">
            <div class="info-row">
                <div class="label">Родной язык: </div>
                <div class="labeled"><?php if (!empty($qr_data['languages'])) { echo $qr_data['languages']; } else { echo "<span class='notcompl'>Информация не заполнена</span>"; } ?></div>
            </div>
        </div>

        <div class="short-info">
            <div class="info-row">
                <div class="label">О себе: </div>
                <div class="labeled"><?php if (!empty($qr_data['about'])) { echo $qr_data['about']; } else { echo "<span class='notcompl'>Информация не заполнена</span>"; } ?></div>
            </div>
        </div>
    </div>

    <div class="page-block write-post-block">
        <a class="profile-image" href="/profile.php"><img src="<?php echo $my_data['photo_url']; ?>" alt=""></a>

        <form class="write-post-form" action="/wall/post.php" method="post">
            <textarea class="field text-field" name="text"></textarea>
            <input class="button" type="submit" name="save" value="Отправить">
        </form>
    </div>

    <?php
        // Это бы убрать вообще в отдельный файл, если делать без AJAX запросов
        $select_qr = mysqli_query($db, "SELECT `id`, `author_id`, `target_id`, `content`, `like_count`, `like_list` FROM `wall` WHERE `target_id`='$qr_id' ORDER BY `id` DESC");

        if ($select_qr) {
            while($post = mysqli_fetch_assoc($select_qr)) {
                $post_author = getUserInfo($post['author_id']);
                // isLiked($post['id'], )
                ?>
                <div class="page-block post-block">
                    <div class="post-info">
                        <a class="profile-image" href="/profile.php?id=<?php echo $post_author['id']; ?>"><img src="<?php echo $post_author['photo_url']; ?>" alt=""></a>

                        <a class="post-author-link" href="/profile.php?id=<?php echo $post_author['id']; ?>"><?php echo $post_author['first_name'].' '.$post_author['last_name']; ?></a>
                    </div>

                    <div class="post-content">
                        <?php echo $post['content']; ?>
                    </div>

                    <div class="post-actions">
                        <?php if (preg_match('/'.$my_id.', /m', $post['like_list'])) { ?>
                            <a class="post-button liked" href="/wall/like.php?post=<?php echo $post['id']; ?>">Вы оценили <?php echo '('.$post['like_count'].')'; ?></a>
                        <?php } else { ?>
                            <a class="post-button" href="/wall/like.php?post=<?php echo $post['id']; ?>">Оценить <?php echo '('.$post['like_count'].')'; ?></a>
                        <?php } ?>

                        <?php if ($post['author_id'] == $my_id || $post['target_id'] == $my_id) { ?>
                            <a class="post-button" href="wall/delete.php?id=<?php echo $post['id']; ?>">Удалить</a>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
        }
    ?>
</div>
