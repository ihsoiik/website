
<?php
session_start();

// Подключение к базе данных
$db_host = 'localhost:3306';
$db_username = 'root';
$db_password = '';
$db_name = 'tour';

// Создание соединения
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $user_mail = $_POST['user_mail']; 
    $hotel_id = $_POST['hotel_id'];
    $date_trip = $_POST['date_trip'];
    $visa = isset($_POST['visa']) ? 1 : 0;
    $transver = isset($_POST['transver']) ? 1 : 0;
    $air_travel = isset($_POST['air_travel']) ? 1 : 0;

    // Проверка наличия записи с такими значениями перед вставкой
    $sql_check = "SELECT * FROM aplication WHERE hotel_id='$hotel_id' AND user_mail='$user_mail'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        echo " data in system.";
    } else {
        // Подготовка и выполнение запроса на вставку данных в таблицу "aplication"

        $sql_insert = "INSERT INTO aplication (hotel_id, user_mail, date_trip, visa, transver, air_travel) 
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("iisiii", $hotel_id, $user_mail, $date_trip, $visa, $transver, $air_travel);

        if ($stmt->execute()) {
            echo "added";
        } else {
            echo "err added: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
