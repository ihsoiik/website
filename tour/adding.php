// Подготовка и выполнение запроса на вставку данных в таблицу "aplication"
$sql_insert = "INSERT INTO aplication (hotel_id, user_id, date_trip, visa, transver, air_travel) 
               VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("iisiii", $hotel_id, $user_id, $date_trip, $visa, $transver, $air_travel);

if ($stmt->execute()) {
    echo "Данные успешно добавлены";
} else {
    echo "Ошибка при добавлении данных: " . $stmt->error;
}

$stmt->close();
