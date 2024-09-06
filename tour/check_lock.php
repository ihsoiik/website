<?php
$aplication_id = $_GET['aplication_id'];
$lockFile = 'lock_' . $aplication_id . '.lock';

if (file_exists($lockFile)) {
    echo json_encode(['locked' => true]);
    exit;
}

// Создание временного файла для блокировки
$file = fopen($lockFile, "w");
fclose($file);

echo json_encode(['locked' => false]);
exit;
?>
