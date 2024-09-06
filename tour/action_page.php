<?php

$login = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$num = filter_var(trim($_POST['num']), FILTER_SANITIZE_STRING);
$psw = filter_var(trim($_POST['psw']), FILTER_SANITIZE_STRING);

$acs = "1";

if (mb_strlen($login) < 5 || mb_strlen($login) > 90) {
    echo "Длина email некорректная";
    exit();
} elseif (mb_strlen($name) < 3 || mb_strlen($name) > 90) {
    echo "Длина имени некорректная";
    exit();
} elseif (mb_strlen($num) < 3 || mb_strlen($num) > 50) {
    echo "Длина номера телефона некорректная";
    exit();
} elseif (mb_strlen($psw) < 2 || mb_strlen($psw) > 50) {
    echo "Длина пароля некорректная (от 2 до 50 символов)";
    exit();
}

// Создаем подключение к базе данных
$mysql = new mysqli('localhost:3306', 'root', '', 'tour');
$mysql->set_charset("utf8mb4");

// Подготовленный запрос для вставки данных
$stmt = $mysql->prepare("INSERT INTO `users` (`acs_rights_id`, `user_name`, `user_mail`, `number_tel`, `pasword`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $acs, $name, $login, $num, $psw);

// Попытка выполнить запрос
if (!$stmt->execute()) {
    // Проверяем, является ли ошибка связанной с уникальным ключом
    if ($mysql->errno == 1062) {
        echo "err: Электронная почта уже занята. Пожалуйста, введите другую почту.";
    } else {
        echo "Ошибка при добавлении пользователя: " . $mysql->error;
    }
    exit();
}

$stmt->close();
$mysql->close();

header('Location: http://localhost/tour/project.php#');

?>
