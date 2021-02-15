<?php
    require 'includes/header.php';
?>

<div class="narrow-collumn">
    <?php if (!isset($_SESSION['logged'])) { ?>
        <div class="page-block mobile-only">
            <h3 class="page-block-title">Войти</h3>

            <form class="verical-form" action="user/login.php" method="post" autocomplete="off">
                <input class="field" type="text" name="login" placeholder="Логин">
                <input class="field" type="password" name="password" placeholder="Пароль">
                <input class="button" type="submit" value="Войти">
            </form>
        </div>

        <div class="page-block">
            <h3 class="page-block-title">Новый пользователь</h3>

            <?php if (isset($_SESSION['registered'])) { ?>
                <div class="notice">Теперь вы можете войти</div>
            <?php } ?>

            <form class="verical-form" action="user/register.php" method="post" autocomplete="off">
                <input class="field" type="text" name="first_name" placeholder="Имя">
                <input class="field" type="text" name="last_name" placeholder="Фамилия">
                <input class="field" type="text" name="login" placeholder="Логин">
                <input class="field" type="password" name="password" placeholder="Пароль">
                <input class="button" type="submit" value="Зарегистрироваться">
            </form>
        </div>
    <?php } else { ?>
        <div class="page-block">
            <h3 class="page-block-title">Что теперь?</h3>

            <a class="page-action" href="/profile.php">Посмотреть профиль</a>
            <a class="page-action" href="/search.php">Найти друзей</a>
        </div>
    <?php } ?>

    <?php require 'includes/footer.php'; ?>
</div>

<div class="wide-collumn">
    <div class="page-block">
        <h3 class="page-block-title">Добро пожаловать!</h3>
        <p class="page-block-text">Socion - это лучший сайт, чтобы завести новых друзей, попрактиковаться в языках с носителями языка и познакомиться с путешественниками</p>
        <p class="page-block-text">Socion - это больше, чем просто социальная сеть для написания писем! Люди в нашем сообществе общаются с партнерами на родном языке, встречаются с друзьями для культурного обмена и находят партнеров по путешествиям и друзей</p>
    </div>
</div>
