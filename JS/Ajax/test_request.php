<?php


require_once "dbh_games.inc.php";
$var = $_POST['start'];
$query = "SELECT game_id, game_title, RowNum from (
		SELECT game_id, game_title, row_number() OVER () as RowNum  FROM games) as t1
		WHERE RowNum > $var and RowNum < 10;";
	
	$stmt = $pdo->prepare($query);
		
	$stmt->execute();
	
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result);
	$stmt = null;
	$pdo = null;
	die();