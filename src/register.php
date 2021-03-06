<?php
    if (isset($_SESSION['logged'])) {
        header('Location:/profile.php');
    }

    require 'includes/header.php';
?>

<div class="centered-wrap">
    <div class="page-block">
        <h3 class="page-block-title">Новый пользователь</h3>

        <?php if (isset($_SESSION['registered'])) { ?>
           <div class="notice">Теперь вы можете войти</div>
        <?php } ?>

        <?php if (isset($_GET['error'])) { 
            $error_type = $_GET['error'];

            if ($error_type == '1') { ?>
                <div class="error">Ошибка. Некоторые данные были введены не правильно или не были заполнены</div>
            <?php } 

            if ($error_type == '2') { ?>
                <div class="error">Произошла непредвиденная ошибка. Пожалуйста, повторите ввод.</div>
            <?php } ?>
        <?php } ?>

        <form class="verical-form" action="user/register.php" method="post" autocomplete="off">
            <input class="field" type="text" name="first_name" placeholder="Имя">
            <input class="field" type="text" name="last_name" placeholder="Фамилия">
            <input class="field" type="text" name="login" placeholder="Логин">
            <input class="field" type="password" name="password" placeholder="Пароль">
            <input class="button" type="submit" value="Зарегистрироваться">
        </form>
    </div>

    <?php require 'includes/footer.php'; ?>
</div>
