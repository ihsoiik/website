

<?php 


require_once 'creat_bd.php';

try
{
  $pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
  throw new PDOException($e->getMessage(), (int)$e->getCode());
  echo "ошибка подключения к базе данных";
}


createTable('access_rights',
'acs_rights_id int unsigned NOT NULL,
access_right varchar(30) NOT NULL,
PRIMARY KEY (acs_rights_id)');

$result = $pdo->query("SELECT * FROM access_rights");
if (!$result->rowCount())
{
    $pdo->query("INSERT INTO access_rights VALUES 
        (1,'клиент'),
        (2,'сотрудник'),
        (3,'проверяющий отелей')");
}
echo "Таблица access_rights - создана.<br>";
  

createTable('status_ap',
'status_id int unsigned NOT NULL,
status_aplication varchar(100) NOT NULL,
PRIMARY KEY (status_id)');

$result = $pdo->query("SELECT * FROM status_ap");
if (!$result->rowCount())
{
    $pdo->query("INSERT INTO status_ap VALUES 
        (0,'новая'),
        (1,'обраюотка'),
        (2,'отклонена'),
        (3,'подтверждена'),
        (4,'изменена'),
        (5,'оплачена'),
        (6,'отменена')");
}
echo "Таблица status_ap - создана.<br>";


createTable('users',
'user_id int unsigned NOT NULL AUTO_INCREMENT,
acs_rights_id int unsigned NOT NULL,
user_name varchar(100) NOT NULL,
user_mail varchar(100) NOT NULL,
number_tel varchar(20) DEFAULT NULL,
password varchar(300) NOT NULL,
FOREIGN KEY (acs_rights_id) REFERENCES access_rights (acs_rights_id),
PRIMARY KEY (user_id)');


echo "Таблица users - создана.<br>";


try
{
createTable('aplication',
'aplication_id int unsigned NOT NULL AUTO_INCREMENT,
status_id int unsigned NOT NULL,
wishes varchar(1000) NOT NULL,
date_trip date NOT NULL,
user_verificator_id int unsigned DEFAULT NULL,
user_Hotel_expert_id int unsigned DEFAULT NULL,
fly_see bool not null default 0,
trip_to_the_cave bool not null default 0,
FOREIGN KEY (id_application) REFERENCES add_service (id_service),
FOREIGN KEY (id_application) REFERENCES hotel (id_hotel),
FOREIGN KEY (user_id) REFERENCES users(user_id),
FOREIGN KEY (user_verificator_id) REFERENCES users(user_id),
FOREIGN KEY (user_Hotel_expert_id) REFERENCES users(user_id),
FOREIGN KEY (status_id) REFERENCES status_ap(status_id),
PRIMARY KEY (aplication_id)');

echo "Таблица aplication - создана.<br>";
}
catch (PDOException $e)
{
  echo "<br>" . $e->getMessage();
}

//таблица формы для измененения статусва
try
{
createTable('aplication_log',
'operation_id int unsigned NOT NULL AUTO_INCREMENT,
operation_datatime datetime NOT NULL,
aplication_id int unsigned NOT NULL,
user_id int unsigned NOT NULL,
last_status_id int unsigned DEFAULT NULL,
present_status_id int unsigned NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(user_id),
FOREIGN KEY (aplication_id) REFERENCES aplication_form(aplication_id), 
FOREIGN KEY (last_status_id) REFERENCES status_ap(status_id),
FOREIGN KEY (present_status_id) REFERENCES status_ap(status_id),
PRIMARY KEY (operation_id)');


echo "Таблица aplication_log - создана.<br>";
}
catch (PDOException $e)
{
  echo "<br>" . $e->getMessage();
}



try
{
createTable('hotel',
'hotel_id int unique not null,
1_room bool not null default 0,
2_room bool not null default 0,
country varchar(50) NOT null,
primary key (hotel_id)');


echo "Таблица hotel - создана.<br>";
}
catch (PDOException $e)
{
  echo "<br>" . $e->getMessage();
}

{
createTable('add_service',
'   id_service int unique not null,
visa bool not null default 0,
transver bool not null default 0,
air_travel bool not null default 0,
primary key (id_service)');
} 
/*    
echo "Таблица hotel - создана.<br>";
}
catch (PDOException $e)
{
    echo "<br>" . $e->getMessage();
}

*/


//окно с пожеланиями
try
{
createTable('chat_aplication',
'id_mesage int unsigned NOT NULL AUTO_INCREMENT,
aplication_id int unsigned NOT NULL,
user_inv_id int unsigned NOT NULL,
user_ver_id int unsigned NOT NULL,
in_out BOOL NOT NULL,
mesage varchar(250),
FOREIGN KEY (user_inv_id) REFERENCES users(user_id),
FOREIGN KEY (user_ver_id) REFERENCES users(user_id),
FOREIGN KEY (aplication_id) REFERENCES aplication_form(aplication_id), 
PRIMARY KEY (id_mesage)');


echo "Таблица chat_aplication - создана.<br>";
}
catch (PDOException $e)
{
  echo "<br>" . $e->getMessage();
}

$uname = $email = $utel = $upsw = $urole = "";
$uname = sanitizeString("Лоентьев Леонид Леонидович");
$email = sanitizeString("test.ru");
$unum  = sanitizeString("444333");
$upsw  = sanitizeString("tour");
$urole = sanitizeString("2");
$upswh = password_hash ($upsw, PASSWORD_DEFAULT);


$result1 = $pdo->query("SELECT * FROM users WHERE user_mail='$email'");

if ($row = $result1->fetch())
{
    echo "пользователь " . $uname . " - уже зарегестрирован <br>";
}
else
{      
    $result = $pdo->query("INSERT INTO users VALUES 
    (NULL, '$urole','$uname', '$email','$utel', '$ureg', '$upswh')");
    echo "пользователь Иванов Иван зарегестрирован <br>";
}


/*
try
{
createTable('aplication_deleted_t',
'del_id int unsigned NOT NULL AUTO_INCREMENT,
aplication_deleted_id int unsigned NOT NULL,
user_id int unsigned NOT NULL,
status_id int unsigned NOT NULL,
name_invention varchar(100) NOT NULL,
description_invention varchar(1000) NOT NULL,
formula_invention varchar(300) NOT NULL,
full_description_invention varchar(3000) NOT NULL,
bibliograf_invention varchar(300) DEFAULT NULL,
date_registration date NOT NULL,
date_finish date DEFAULT NULL,
user_verificator_id int unsigned DEFAULT NULL,
user_expert_plag_id int unsigned DEFAULT NULL,
user_expert_znak_id int unsigned DEFAULT NULL,
user_patent_regs_id int unsigned DEFAULT NULL,
FOREIGN KEY (user_id) REFERENCES users(user_id),
FOREIGN KEY (user_verificator_id) REFERENCES users(user_id),
FOREIGN KEY (user_expert_plag_id) REFERENCES users(user_id),
FOREIGN KEY (user_expert_znak_id) REFERENCES users(user_id),
FOREIGN KEY (user_patent_regs_id) REFERENCES users(user_id),
FOREIGN KEY (status_id) REFERENCES status_ap(status_id),
PRIMARY KEY (del_id)');

echo "Таблица aplication_deleted - создана.<br>";
}
catch (PDOException $e)
{
  echo "<br>" . $e->getMessage();
}



try
{
createTable('aplication_log_t',
'operation_id int unsigned NOT NULL AUTO_INCREMENT,
operation_datatime datetime NOT NULL,
aplication_id int unsigned NOT NULL,
user_id int unsigned NOT NULL,
last_status_id int unsigned DEFAULT NULL,
present_status_id int unsigned NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(user_id),
FOREIGN KEY (aplication_id) REFERENCES aplication_form(aplication_id), 
FOREIGN KEY (last_status_id) REFERENCES status_ap(status_id),
FOREIGN KEY (present_status_id) REFERENCES status_ap(status_id),
PRIMARY KEY (operation_id)');


echo "Таблица aplication_log_t - создана.<br>";
}
catch (PDOException $e)
{
  echo "<br>" . $e->getMessage();
}



try
{

$uname = $email = $utel  = $ureg  = $upsw = $urole = "";
$uname = "NULL";
$email = "nul@nul.ru";
$utel  = "+70000000000";
$ureg  = "NULL";
$upsw  = "nul";
$urole = "0";
$upswh = password_hash ($upsw, PASSWORD_DEFAULT);  

$result1 = $pdo->query("SELECT * FROM users WHERE user_mail='$email'");
  
if (!$result1->rowCount())
{      
    $upswh = password_hash ($upsw, PASSWORD_DEFAULT);
    $result = $pdo->query("INSERT INTO users VALUES 
    (NULL, '$urole','$uname', '$email','$utel', '$ureg', '$upswh')");
    echo "пользователь NULL зарегестрирован<br>";
}
else
{
  echo "пользователь " . $uname . " - уже зарегестрирован <br>";
}     
}
catch (PDOException $e)
{
  echo "<br>" . $e->getMessage();
}









try
{
$uname = $email = $utel  = $ureg  = $upsw = $urole = "";
$uname = "Иванов Иван";
$email = "ivi@ivi.ru";
$utel  = "+7 (910) 123 11 11";
$ureg  = "Васюки";
$upsw  = "ivi";
$urole = "4";
$upswh = password_hash ($upsw, PASSWORD_DEFAULT);

$result1 = $pdo->query("SELECT * FROM users WHERE user_mail='$email'");

if ($result1->rowCount())
{
    echo "пользователь " . $uname . "уже зарегестрирован";
}
else
{      
    $result = $pdo->query("INSERT INTO users VALUES 
    (NULL, '$urole','$uname', '$email','$utel', '$ureg', '$upswh')");
    echo "пользователь Иванов Иван зарегестрирован";
}
   
}
catch (PDOException $e)
{
  echo "<br>" . $e->getMessage();
}


*/



$triger = "CREATE TRIGGER `log_change` AFTER UPDATE ON `aplication_form` FOR EACH ROW BEGIN 
	INSERT INTO aplication_log_t 
	set
	operation_datatime = NOW(), 
	aplication_id = NEW.aplication_id,
	user_id = NEW.user_id,
	last_status_id = OLD.status_id,
	present_status_id = NEW.status_id;
END";

try
{
  $result1 = $pdo->query($triger);
  echo "Тригер создан - для логов изменения статусов в таблице заявок";
}
catch (PDOException $e)
{
  echo "<br>" . $e->getMessage();
}
?>