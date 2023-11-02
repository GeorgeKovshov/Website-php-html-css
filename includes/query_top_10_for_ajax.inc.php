<?php


require_once "dbh_games.inc.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['company'])){
		$var = $_POST['company'];
		$query = "SELECT title FROM publisher WHERE title like '%" . $var . "%' LIMIT 10;";
	} else if(isset($_POST['developer'])) {
		$var = $_POST['developer'];
		$query = "SELECT title FROM developer WHERE title like '%" . $var . "%' LIMIT 10;";
	} else if(isset($_POST['designer'])) {
		$var = $_POST['designer'];
		$query = "SELECT full_name FROM people WHERE full_name like '%" . $var . "%' LIMIT 10;";
	} else {
		$pdo = null;
		die();
	}		
		$stmt = $pdo->prepare($query);
			
		$stmt->execute();
		
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($result);
		$stmt = null;
		$pdo = null;
		die();
	
}else{

	header("Location: ../main_page.php");
	die();
}
