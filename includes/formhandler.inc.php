<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){
	$start = $_POST["start"];
	$end = $_POST["end"];
	$price = $_POST["price"];
	
	try{
		require_once "dbh.inc.php";
		
		$query = "INSERT INTO water_company(start, end, price) VALUES(:start, :end, :price);";
		
		$stmt = $pdo->prepare($query);
		echo "3"; echo "$start";
		$stmt->bindParam(":start", $start);
		$stmt->bindParam(":end", $end);
		$stmt->bindParam(":price", $price);
		
		$stmt->execute();
		
		$pdo = null;
		$stmt = null;
		header("Location: ../mysql_site.php");
		die();
	} catch (PDOException $e){
		die("Query failed: " . $e->getMessage());
	}
	
	
} else {
	header("Location: ../mysql_site.php");
}
	