<?php
// Параметры подключения к базе данных MySQL
$servername = 'localhost:3306';
$username = 'root';
$password= '';
$dbname = 'tour';

// Создание подключения к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения на ошибки
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из POST-запроса
$application_id = $_POST['application_id'];
$new_status = $_POST['new_status'];

// SQL запрос для обновления статуса
$sql = "UPDATE aplication SET status_id = '$new_status' WHERE aplication_id = '$application_id'";

// Выполнение запроса
if ($conn->query($sql) === TRUE) {
    echo "Статус изменен успешно";
} else {
    echo "Ошибка при изменении статуса: " . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>
