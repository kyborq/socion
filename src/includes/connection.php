<?php

// Данные авторизации
$host_name = "localhost"; // Имя хоста
$db_user = "podyganov"; // Имя пользователя базы данных
$db_pass = "6Fm5dcZzpMvzw6hz"; // Пароль пользователя от базы данных
$db_name = "socion"; // Имя базы данных

// Соединение с базой данных
// $db = mysqli_connect($host_name, $db_user, $db_pass); // Соединение
// mysqli_select_db($db, $db_name); // Выбор базы данных
$db = mysqli_connect($host_name, $db_user, $db_pass, $db_name);
mysqli_set_charset($db, "utf8"); // Установка кодировки utf-8

$time = getdate();

?>
