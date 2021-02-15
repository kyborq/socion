<?php
    if(isset($_SESSION['logged'])) {
        header('Location:/profile.php');
    }

    session_start();
    require '../includes/connection.php';
    require '../includes/functions.php';

    $first_name = $last_name = $login = $password = '';

    $first_name = cleanString($first_name);
    $last_name = cleanString($last_name);
    $login = cleanString($login);
    $password = cleanString($password);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Проверка на правильность ввода имени
        if (empty($_POST["first_name"])) {
            $errName = "Имя обязательно<br>";
        } else {
            $first_name = $_POST['first_name'];
            if (!preg_match("/^[а-яА-ЯёЁa-zA-Z]+/m", $first_name)) {
                $errName = "В имени разрешены только буквы<br>";
                $first_name = '';
            }
        }

        // Проверка на правильность ввода фамилии
        if (empty($_POST["last_name"])) {
            $errName = "Фамилия обязательно<br>";
        } else {
            $last_name = $_POST['last_name'];
            if (!preg_match("/^[а-яА-ЯёЁa-zA-Z]+/m", $last_name)) {
                $errName = "В фамилии разрешены только буквы<br>";
                $last_name = '';
            }
        }

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
        header('Location:/register.php?error=1');
    } else {
        $userID = newUser($first_name, $last_name, $login, $password);
        if (isset($userID)) {
            $_SESSION['uid'] = $userID;
            $_SESSION['registered'] = true;
            header('Location:/index.php');
        } else {
            header('Location:/register.php?error=2');
        }
    }
?>
