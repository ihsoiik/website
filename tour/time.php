<?php
session_start();
require_once 'functions.php';
$userstr = '';
$randstr = substr(md5(rand()), 0, 1);
$max_s_time = 60 * 1; // максимальное время работы, 1 минута
$now_time = time();

// Проверяем, была ли установлена переменная в сессии для времени последнего посещения страницы
if (isset($_SESSION['s_time'])) {
    $l_s_time = $_SESSION['s_time'];
} else {
    $l_s_time = $now_time; // Устанавливаем текущее время при первом посещении страницы
}

// Проверяем, авторизован ли пользователь
if (isset($_SESSION['uname'])) {
    $uname    = $_SESSION['uname'];
    $role     = $_SESSION['role'];
    $umail    = $_SESSION['umail'];
    $rigid    = $_SESSION['rigid']; // права доступа
    $uid      = $_SESSION['userid'];

    // Проверяем, истекло ли максимальное время работы сессии
    if (($l_s_time + $max_s_time) < $now_time) {
        destroySession();
        header("Location: http://localhost/patent/index1.php?formsubmit=$randstr");
        exit; // Важно завершить выполнение скрипта после перенаправления
    }

    $loggedin = TRUE;
    $userstr  = $uname . " : " . $role . "  ";
} else {
    $loggedin = FALSE;
}

$_SESSION['s_time'] = $now_time; // Переписываем на текущее время
?>
