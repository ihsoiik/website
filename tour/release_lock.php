<?php
$aplication_id = $_GET['aplication_id'];
$lockFile = 'lock_' . $aplication_id . '.lock';

// Удаление временного файла блокировки заявки
if (file_exists($lockFile)) {
    unlink($lockFile);
}

exit;
?>
