<?php
// Подключение к базе данных
$servername = 'localhost:3306';
$username = 'root';
$password = '';
$dbname = 'tour';

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение application_id из параметров URL
$applicationId = $_GET['application_id'];

// Получение нового статуса из формы, если он был отправлен
$newStatus = isset($_POST['new_status']) ? $_POST['new_status'] : null;

// Если новый статус был отправлен, обновляем статус заявки
if ($newStatus !== null) {
    // Начинаем транзакцию
    $conn->begin_transaction();

    // Устанавливаем блокировку таблицы для текущей заявки
    $sql_lock = "LOCK TABLES aplication WRITE";
    $conn->query($sql_lock);
    sleep(10);

    // Проверяем, не изменяется ли заявка другим пользователем
    $proba = "SELECT aplication_user FROM aplication WHERE aplication_id = '$applicationId' FOR UPDATE";
    $result = $conn->query($proba);

    if ($result === false) {
        echo "Ошибка выполнения запроса: " . $conn->error;
        // Откатываем транзакцию и снимаем блокировку таблицы
        $conn->rollback();
        $sql_unlock = "UNLOCK TABLES";
        $conn->query($sql_unlock);
    } else {
        $row = $result->fetch_assoc(); // Получаем ассоциативный массив результата
        $aplication_users = (int)$row['aplication_user']; // Преобразуем значение в целое число

        // Если заявка не изменяется другим пользователем, обновляем её статус
        if ($aplication_users == 0) {
            // Устанавливаем флаг пользователя, который изменяет статус заявки
            $sql_user_flag = "UPDATE aplication SET aplication_user = 1 WHERE aplication_id = '$applicationId'";
            $conn->query($sql_user_flag);

            // Обновляем статус заявки
            $sql_update_status = "UPDATE aplication SET status_id = '$newStatus' WHERE aplication_id = '$applicationId'";
            if ($conn->query($sql_update_status) === TRUE) {
                echo "Status updated successfully";
                // Снимаем блокировку таблицы и фиксируем транзакцию
                $sql_unlock = "UNLOCK TABLES";
                $conn->query($sql_unlock);
                $conn->commit();
                $sql_user_flag = "UPDATE aplication SET aplication_user = 0 WHERE aplication_id = '$applicationId'";
            $conn->query($sql_user_flag);
            } else {
                echo "Ошибка при обновлении статуса: " . $conn->error;
                // Откатываем транзакцию и снимаем блокировку таблицы
                $conn->rollback();
                $sql_unlock = "UNLOCK TABLES";
                $conn->query($sql_unlock);
            }
        } else {
            echo "The application is already being modified by another user";
            // Откатываем транзакцию и снимаем блокировку таблицы
            $conn->rollback();
            $sql_unlock = "UNLOCK TABLES";
            $conn->query($sql_unlock);
        }
    }
}

// Запросить данные о заявке для отображения в форме
$sql_select = "SELECT * FROM aplication WHERE aplication_id = '$applicationId'";
$result = $conn->query($sql_select);

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

// Закрытие соединения с базой данных
$conn->close();
?>
