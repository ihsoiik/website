<?php 
  session_start();
  require_once 'project.php';
  require_once 'login.php';
  

try
{
  $pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
  throw new PDOException($e->getMessage(), (int)$e->getCode());
  echo "ошибка подключения к базе данных";
}


if (!$loggedin) header("Location: http://localhost/tour/project.php#");

try{
    $query1 ="SELECT ar.access_right
    FROM users u
    JOIN access_rights ar ON u.acs_rights_id = ar.acs_rights_id
    WHERE u.user_id = {здесь указывается ID пользователя};"

    $rigid = $pdo->query($query1);
}

if ($rigid == 3)
{
  require_once 'aplication3.php';
}



if ($rigid == 2)
{

  require_once 'aplication2.php';
}

if ($rigid == 1)
{
  require_once 'aplication1.php';
}


?>