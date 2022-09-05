<?php


$dsn = "mysql:host=localhost;dbname=medcare";

$username = "root";
$password = "";
/*$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8',
);*/

try {
  $con = new PDO($dsn, $username, $password);
  // set the PDO error mode to exception
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} 

catch(PDOException $e) {

    echo "Connection failed: " . $e->getMessage();
}


?>