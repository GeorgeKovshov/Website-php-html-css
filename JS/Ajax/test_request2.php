<?php


require_once "dbh_games.inc.php";
if(isset($_POST['name'])){
	
	$var = $_POST['name'];

	$query = "SELECT game_id, game_title FROM games where game_title LIKE '%" . $var . "%';";
	
	$stmt = $pdo->prepare($query);
		
	$stmt->execute();
	
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result);
	$stmt = null;
	$pdo = null;
	die();
}
else{
	//$pdo = null;
	//die();
}