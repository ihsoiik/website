<?php
session_start();

// Проверяем, переданы ли электронная почта и пароль через POST
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Удаляем возможные пробелы в начале и конце строки
    $email = trim($email);
    $password = trim($password);

    // Проверяем, не пустые ли электронная почта и пароль
    if ($email == '' || $password == '') {
        exit("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }

    // Обработка входных данных, чтобы предотвратить SQL-инъекции
    $email = stripslashes($email);
    $email = htmlspecialchars($email);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);

    // Подключение к базе данных
    $host = 'localhost:3306';
    $user = 'root';
    $db_password = '';
    $database = 'tour';
    $mysqli = new mysqli($host, $user, $db_password, $database);

    // Проверка подключения к базе данных
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Запрос для получения данных пользователя
    $query = "SELECT * FROM users WHERE user_mail='$email'";
    $result = $mysqli->query($query);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Проверка пароля
        if ($row['pasword'] == $password) {
            // Устанавливаем сессионные переменные
            $_SESSION['email'] = $email;
            $_SESSION['idUser'] = $row['user_id'];

            // Перенаправляем пользователя в зависимости от acs_rights_id
            if ($row['acs_rights_id'] == 3) {
                header("Location: inspectorpage2.php");
            } else {
                header("Location: project.php");
            }
            exit();
        } else {
            // Неправильный пароль
            echo "error Неверный пароль. <a href='project.php'>Попробуйте снова</a>";
        }
    } else {
        // Пользователь не найден
        echo "err  Пользователь с такой почтой не найден. <a href='project.php'>Попробуйте снова</a>";
    }

    $mysqli->close();
} else {
    // Электронная почта или пароль не переданы
    exit("Необходимо ввести адрес электронной почты и пароль!");
}
?>
