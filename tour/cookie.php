<?php
$cookie_name = 'visit_count';

// Проверяем, есть ли уже установленное значение cookie
if(isset($_COOKIE[$cookie_name])) {
    // Увеличиваем значение cookie на 1
    $visit_count = $_COOKIE[$cookie_name] + 1;
} else {
    // Если cookie не существует, устанавливаем значение равное 1
    $visit_count = 1;
}

// Устанавливаем cookie на 1 год
setcookie($cookie_name, $visit_count, time() + (60*5), '/');

// Выводим количество посещений страницы
echo "Количество посещений страницы: " . $visit_count;
?>
