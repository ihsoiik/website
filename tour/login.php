

<?php
  $host = 'localhost:3306';    // Change as necessary
  $user = "root";
  $pass = "";
  $data = "tour";
  $chrs = 'utf8mb4';
  $attr = "mysql:host=$host;dbname=$data;charset=$chrs";
  $opts =
  [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
$dblink = mysqli_connect($host, $user, $pass, $data);
mysqli_set_charset($dblink, "utf8");

if (!$dblink) 
{
    die("Ошибка подключения: " . mysqli_connect_error());
}
?>
