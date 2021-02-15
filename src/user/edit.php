<?php
    if ($success) {
        header('Location:/profile.php');
    }

    require '../includes/header.php';

    $my_id = $_SESSION['uid'];
    $my_data = getUserInfo($my_id);
?>

<div class="narrow-collumn profile-side">
    <div class="page-block">
        <h3 class="page-block-title">Редактирование</h3>
        <a class="page-action" href="/profile.php">Назад</a>
    </div>

    <?php require '../includes/footer.php'; ?>
</div>

<div class="wide-collumn">
    <div class="page-block">
        <h3 class="page-block-title">Основная информация</h3>

        <?php if ($success) { ?>
            <div class="notice">Информация сохранена</div>
        <?php } ?>

        <?php if ($error) { ?>
            <div class="error">Ошибка</div>
        <?php } ?>

        <form class="edit-form" action="" method="post">
            <div class="short-info">
                <div class="info-row">
                    <div class="label">Фотография профиля: </div>
                    <div class="labeled"><input class="field" type="text" name="p_url" value="<?php echo $my_data['photo_url']; ?>"></div>
                </div>

                <div class="info-row">
                    <div class="label">Имя: </div>
                    <div class="labeled"><input class="field" type="text" name="fname" value="<?php echo $my_data['first_name']; ?>"></div>
                </div>

                <div class="info-row">
                    <div class="label">Фамилия: </div>
                    <div class="labeled"><input class="field" type="text" name="lname" value="<?php echo $my_data['last_name']; ?>"></div>
                </div>

                <div class="info-row">
                    <div class="label">День рождения: </div>
                    <div class="labeled"><input class="field" type="date" name="bday" value="<?php echo $my_data['bday']; ?>"></div>
                </div>

                <div class="info-row">
                    <div class="label">Город: </div>
                    <div class="labeled"><input class="field" type="text" name="city" value="<?php echo $my_data['city']; ?>"></div>
                </div>

                <div class="info-row">
                    <div class="label">Язык: </div>
                    <div class="labeled"><input class="field" type="text" name="language" value="<?php echo $my_data['language']; ?>"></div>
                </div>

                <div class="info-row">
                    <div class="label">О себе: </div>
                    <div class="labeled"><textarea class="field text-field" name="about"><?php echo $my_data['about']; ?></textarea></div>
                </div>
            </div>

            <input class="button" type="submit" value="Сохранить">
        </form>
    </div>
</div>

<?php
    $photo_url = $_POST['p_url'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $bday = $_POST['bday'];
    $city = $_POST['city'];
    $language = $_POST['language'];
    $about = $_POST['about'];

    $fname = cleanString($fname);
    $lname = cleanString($lname);
    $bday = cleanString($bday);
    $city = cleanString($city);
    $language = cleanString($language);
    $about = cleanString($about);

    $qr = mysqli_query($db, "UPDATE `users` SET `photo_url`='$photo_url', `first_name`='$fname', `last_name`='$lname', `bday`='$bday', `city`='$city', `languages`='$language', `about`='$about' WHERE `id`=$my_id");
    if ($qr) {
        $my_data = getUserInfo($my_id);
        $success = true;
        $error = false;
    } else {
        $success = false;
        $error = true;
    }
?>
