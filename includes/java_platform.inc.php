<?php


require_once "dbh_games.inc.php";
if(isset($_POST['publisher'])){
	
	$var = $_POST['publisher'];

	$query = "SELECT title FROM publisher WHERE title like '%" . $var . "%' LIMIT 10;";
	
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