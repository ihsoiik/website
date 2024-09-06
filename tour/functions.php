<?php // Example 01: functions.php

  function createTable($name, $query)
  {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
  }



  function queryMysql($query)
  {
    global $pdo; // Подключ. глоб. перем. $pdo хранящей PDO
    return $pdo->query($query); // SQL-запрос с испол. об. PDO и возврат резов

  }

  function destroySession()
  {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }

  function sanitizeString($var)
  // предотвращаем некорректное выполнение запросов к базе данных.
  {
    global $pdo;

    $var = strip_tags($var); // Удаляет HTML и PHP теги из строки
    $var = htmlentities($var); // Преобразует спец символы в соот HTML сущности
    $var = stripslashes($var); // Удаляет экранирование обратных слешей

    $result = $pdo->quote($var);          // Строку в один кавычки с методом quote() PDO
    return str_replace("'", "", $result); // So now remove them
  }



  function change_status_log ($status_id, $aplication_id)
  {
    global $pdo;

    $result0 = queryMysql("SELECT * FROM aplication_form WHERE aplication_id='$aplication_id'");
    $row0 = $result0->fetch();
    $last_status_id     = $row0['status_id']; // из бд
    $user_id            = $_SESSION['userid']; // берем из сессии
    $present_status_id  = $status_id; // меняю на входящую переменную функции 

    if ($last_status_id != $present_status_id)
    {
      for ($i=0; $i<=10; $i++) // повторяем 10 раз - если табл заблокирована чтобы получилось записать данные
      {
        $err = "";

        try
        { 
          $pdo->beginTransaction(); // начало транзакции для обьекта pdo

          queryMysql("LOCK TABLES aplication_form WRITE"); // блокируем таблицу от записей
          
          $pdo->query ("UPDATE aplication_form SET status_id=$status_id WHERE aplication_id=$aplication_id"); // новый статус

          queryMysql("LOCK TABLES aplication_log WRITE");     // блокируем
      
          $operation_datatime = date("Y-m-d h:i:s"); // текущее время
        
          queryMysql ("INSERT INTO aplication_log 
          VALUES(
           NULL,
           '$operation_datatime',
           '$aplication_id',
           '$user_id',
           '$last_status_id',
           '$present_status_id')"); // новая запись
            
          $pdo->commit(); // завершение транзакции 

          queryMysql("UNLOCK TABLES"); // разблокировка таблиц
        
          echo "<script>alert('New record created successfully'); </script>";  // пример джавы

          break;
        
          header("Location: aplications2.php");
        }
        catch(PDOException $e)
        {
          echo "<br>" . $e->getMessage(); // вывод ошибки
          $pdo->rollback(); // откат транзакции обратно 
          $err = $e->getMessage(); // сообщение об ошибке присвается переменной
        }
        queryMysql("UNLOCK TABLES"); // разблокировка

      }
      if ($err!="")
        echo "Доступ к базе данных заблокирован - попробуйте повторить запрос позже!";
    }
  return;

  }

  function registration_patent ($aplication_id, $number_patent)
  {
    global $pdo;

    $result0 = queryMysql("SELECT * FROM aplication_form WHERE aplication_id='$aplication_id'");
    $row0 = $result0->fetch();
    $status_id = $row0['status_id'];
    if ($status_id != 11)
      return;

    $user_id                    = $row0['user_id'];
    $name_invention             = $row0['name_invention'];
    $description_invention      = $row0['description_invention'];
    $formula_invention          = $row0['formula_invention'];
    $full_description_invention = $row0['full_description_invention'];
    $bibliograf_invention       = $row0['bibliograf_invention'];
    $date_registration          = $row0['date_registration'];

    
    for ($i=0; $i<=10; $i++)
      {
        $err = "";
        $date_finish = date("Y-m-d h:i:s");
        try
        { 
          $pdo->beginTransaction();

          queryMysql("LOCK TABLES aplication_form WRITE");
          
          //$pdo->query ("UPDATE aplication_form SET date_finish=$date_finish WHERE aplication_id=$aplication_id");

          queryMysql("LOCK TABLES patent_list WRITE");     
               
          queryMysql("INSERT INTO patent_list VALUES(
            NULL, 
            '$aplication_id',
            '$name_invention',
            '$description_invention',
            '$formula_invention',
            '$full_description_invention',
            '$bibliograf_invention',
            '$number_patent',
            '$date_registration',
            '$date_finish')
            ");
                             
          $pdo->commit();

          queryMysql("UNLOCK TABLES");
        
          echo "New record created successfully";

          break;
        
        }
        catch(PDOException $e)
        {
          echo "<br>" . $e->getMessage();
          $pdo->rollback();
          $err = $e->getMessage();
        }
        queryMysql("UNLOCK TABLES");

      }
      if ($err!="")
        echo "Доступ к базе данных заблокирован - попробуйте повторить запрос позже!";
    
  return;

  }












  function showProfile($user)
  {
    global $pdo;

    if (file_exists("$user.jpg"))
      echo "<img src='$user.jpg' style='float:left;'>";

    $result = $pdo->query("SELECT * FROM profiles WHERE user='$user'");

    while ($row = $result->fetch())
    {
      die(stripslashes($row['text']) . "<br style='clear:left;'><br>");
    }
    
    echo "<p>Nothing to see here, yet</p><br>";
  }



  function startSession2() {
    // Если сессия уже была запущена, прекращаем выполнение и возвращаем TRUE
    // (параметр session.auto_start в файле настроек php.ini должен быть выключен - значение по умолчанию)
    if ( session_id() ) return true;
    else return session_start();
    // Примечание: До версии 5.3.0 функция session_start()возвращала TRUE даже в случае ошибки.
    // Если вы используете версию ниже 5.3.0, выполняйте дополнительную проверку session_id()
    // после вызова session_start()
  }
  
  function destroySession2() {
    if ( session_id() ) {
      // Если есть активная сессия, удаляем куки сессии,
      setcookie(session_name(), session_id(), time()-60*60*24);
      // и уничтожаем сессию
      session_unset();
      session_destroy();
    }
  }



?>
