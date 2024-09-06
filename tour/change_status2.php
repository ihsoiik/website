<?php
// Подключение к базе данных
$servername = 'localhost:3306';
$username = 'root';
$password= '';
$dbname = 'tour';

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_query($conn, "LOCK TABLES orders WRITE;");
// Получение application_id из параметров URL
$applicationId = $_GET['application_id'];
// $user_mail1 = $_GET['user_mail'];

$proba="SELECT aplication_user FROM aplication WHERE  aplication_id = '$applicationId'";
$result = $conn->query($proba);
sleep(20);

if ($result === false) {
    echo "Ошибка выполнения запроса: " . $conn->error;
} else {
    $row = $result->fetch_assoc(); // Получаем ассоциативный массив результата
    $aplication_users = (int)$row['aplication_user']; // Преобразуем значение в целое число

    if ($aplication_users == 1) {
        // Ваш код, если $aplication_users равно 1
        $_SESSION['message'] = "Вы больше не можете взять заказ на выполнение! Завершите предыдущие заказы";
    } elseif ($aplication_users == 0) {
        // Ваш код, если $aplication_users равно 0
        // Если форма была отправлена, обработать данные
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Получение нового статуса из формы
            $newStatus = $_POST['new_status'];
        
            // Выполнить SQL запрос для обновления статуса
            $sql = "UPDATE aplication SET status_id = '$newStatus' WHERE aplication_id = '$applicationId'";
        
            // Выполнение запроса
            if ($conn->query($sql) === TRUE) {
                echo "DONE";
                mysqli_query($conn, "UNLOCK TABLES"); // Перенесено сюда
                // Теперь обновляем aplication_user
                // $sql2 = "UPDATE aplication SET aplication_user = 0 WHERE aplication_id = '$applicationId'";
                // $result = $conn->query($sql2);
            } else {
                echo "ERR " . $conn->error;
            }
        }
    
        // Запросить данные о заявке для отображения в форме
        $sql = "SELECT * FROM aplication WHERE aplication_id = '$applicationId'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Отобразить форму для изменения статуса
            echo "<form method='post' action=''>
                    <label for='newStatus'><b>NEW STATUS</b></label>
                    <input type='text' placeholder='ENTER' name='new_status' required>
                    <button type='submit'>CHANGE</button>
                </form>";
        } else {
            echo "Заявка не найдена";   
        }
    } else {
        echo "Недопустимое значение $aplication_users"; // Вывод сообщения об ошибке, если значение отличается от 0 или 1
    }
}



   


// Закрытие соединения с базой данных
$conn->close();
?>
