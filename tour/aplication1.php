<?php 

echo <<<_begin

<link rel='stylesheet' href='styles.css' type='text/css'>
<style>

/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {   
    float: left;
    width: 25%;
    background-color: #f12f12f12;
    padding-left: 20px;
}
/* Right column */
.rightcolumn {
    float: left;
    width: 75%;
    background-color: #f1f1f1;
    padding-left: 20px;
}
/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
    .leftcolumn, .rightcolumn {   
        width: 100%;
        padding: 0;
    }
}
/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
    .topnav a {
        float: none;
        width: 100%;
    }
}
</style>
<style>
/* Style inputs with type="text", select elements and textareas */
input[type=text], select, textarea {
    width: 100%; /* Full width */
    padding: 12px; /* Some padding */  
    border: 1px solid #ccc; /* Gray border */
    border-radius: 4px; /* Rounded borders */
    box-sizing: border-box; /* Make sure that padding and width stays in place */
    margin-top: 6px; /* Add a top margin */
    margin-bottom: 16px; /* Bottom margin */
    resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}



/* Add a background color and some padding around the form */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 0px solid #ddd;
  
}

th, td {
  text-align: left;
  padding: 6px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}

</style>




<div class="row">
  <h2 align="center">Заявки на патент</h2>
</div>
<div class="row">
  <div class="leftcolumn">
    <div class="toph" align="center">
      <a align="center">Новая заявка</a>
    </div>       
    <div align='center'>
      <button  onclick="document.getElementById('id001').style.display='block'" style="width:auto;">Сформировать новую заявку</button>
    </div>
    <p align='center'>Информация как подать заявку и как отследить ее статус </p>
    </div>
  <div class="rightcolumn">
    <div class="toph" align="center">
        <a align="center">Поданные заявки</a>
    </div>
_begin;
 
try
{
  $query1 = "SELECT a.aplication_id, a.user_id, s.status_aplication, a.status_id, a.date_trip
  FROM aplication a
  JOIN status_ap s ON a.status_id = s.status_id;";
   $result1 = $pdo->query($query1);
}
catch(PDOException $e)
{
  echo "<br>" . $e->getMessage();
} 

if ($result1->fetch())
{
    $result1 = $pdo->query($query1);
    echo "<table style='width:100%; font-size: 14px;'>
          <tr>
          <th style='width:10%'>Номер</th> 
          <th style='width:15%'>Дата</th> 
          <th style='width:25%'>Статус</th> 
          </tr>";

    while ($row1 = $result1->fetch())
    {
        $aplication_id    = stripslashes($row1['aplication_id']);
        $status_id        = stripslashes($row1['status_id']);
        $date_registration= stripslashes($row1['date_drip']);
    
        $tatus             = stripslashes($row1['status_aplication']);
               
        echo "<tr> <td>$aplication_id</td> <td> $date_registration</td>  <td>$tatus</td> </tr>";
    }
    echo "</table>";
}
else
{
    echo '<p align="center">Вы пока не подавали заявок!</p>';
}





  </div>
</div>

<div class="footer">
      <p>© 2023 Апалькова Мария</p>
    </div>

</body>
</html>
_form;


?>
