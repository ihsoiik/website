<?php
// Подключение к базе данных
$servername = 'localhost:3306';
$username = 'root';
$password = '';
$dbname = 'tour';

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL запрос для создания триггера
$query = "
CREATE TRIGGER check_and_set_admin_rights
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
    -- Проверка существования почты
    DECLARE email_count INT;
    SELECT COUNT(*) INTO email_count FROM users WHERE user_mail = NEW.user_mail;
    IF email_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Такая почта уже используется, введите другую почту.';
    END IF;
    
    -- Установка прав доступа, если почта начинается с 'admin'
    IF NEW.user_mail LIKE 'admin%' THEN
        SET NEW.acs_rights_id = 2;
    END IF;
END;
";

// Выполнение запроса
if ($mysqli->query($query) === TRUE) {
    echo "Триггер успешно создан";
} else {
    echo "Ошибка при создании триггера: " . $mysqli->error;
}
?>
