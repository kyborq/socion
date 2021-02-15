<?php
    if (isset($_SESSION['logged'])) {
        header('Location:/profile.php');
    }
    
    session_start();
    require '../includes/connection.php';
    require '../includes/functions.php';

    $login = $password = '';

    $login = cleanString($login);
    $password = cleanString($password);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Проверка на правильность ввода логина
        if (empty($_POST["login"])) {
            $errName = "Логин обязательно<br>";
        } else {
            $login = $_POST['login'];
            if (!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
                $errName = "Разрешены только буквы и цифры латинского алфавита<br>";
                $login = '';
            }
        }

        // Проверка на правильность ввода пароля
        if (empty($_POST["password"])) {
            $errName = "Пароль обязательно<br>";
        } else {
            $password = $_POST['password'];
            if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
                $errName = "Разрешены только буквы и цифры латинского алфавита<br>";
                $password = '';
            }
        }
    }

    if (!empty($errName)) {
        header('Location:/login.php?error=1');
        // ошибка
    } else {
        $userID = authUser($login, $password);
        if (isset($userID)) {
            $_SESSION['uid'] = $userID;
            $_SESSION['logged'] = true;
            $_SESSION['registered'] = null;
            header('Location:/profile.php');
        } else {
            header('Location:/login.php?error=2');
        }
    }
?>
