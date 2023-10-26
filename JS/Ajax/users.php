<?php


require_once "dbh_games.inc.php";
$query = "SELECT * FROM games;";
	
	$stmt = $pdo->prepare($query);
		
	$stmt->execute();
	
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result);
	$stmt = null;
	$pdo = null;
	die();