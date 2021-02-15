<?php
    session_start();
    require 'connection.php';
    require 'functions.php';

    $my_id = $_SESSION['uid'];
    $my_data = getUserInfo($my_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Socion</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/page.css">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="stylesheet" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/pm.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="top">
        <div class="header">
            <a class="logo" href="/index.php">SOCION</a>

            <?php if (isset($_SESSION['logged'])) { ?>
                <div class="navigation">
                    <a class="nav-button" href="/pm.php">Сообщения</a>
                    <a class="nav-button" href="/search.php">Поиск</a>
                    <a class="profile-image" href="/profile.php"><img src="<?php echo $my_data['photo_url']; ?>" alt=""></a>
                </div>
            <?php } else { ?>
                <form class="horizontal-form" action="/user/login.php" method="POST" autocomplete="off">
                    <input class="field" type="text" name="login" placeholder="Логин">
                    <input class="field" type="password" name="password" placeholder="Пароль">
                    <input class="button" type="submit" value="Войти">
                </form>
            <?php } ?>

        </div>
    </div>

    <div class="page">
