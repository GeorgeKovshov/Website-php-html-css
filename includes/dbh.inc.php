<?php

/*
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "DTwP7491";
*/

$dsn = "mysql:host=localhost;dbname=DataBase1";
$dbusername = "root";
$dbpassword = "DTwP7491";

//$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, dbName)


try {
	echo "1";
	$pdo = new PDO($dsn, $dbusername, $dbpassword);
	echo "2";
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
} catch(PDOException $e){
	echo "Connection failed: " . $e->getMessage();
	
}
