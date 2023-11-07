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
	} else if(isset($_POST['subgenre'])) {
		$var = $_POST['subgenre'];
		$query = "SELECT genre_name FROM genre WHERE genre_name LIKE '%" . $var . "%' LIMIT 10;";
	} else if(isset($_POST['platform'])) {
		$var = $_POST['platform'];
		$query = "SELECT platform_name FROM platform WHERE platform_name LIKE '%" . $var . "%' LIMIT 10;";
	}  else if(isset($_POST['tag'])) {
		$var = $_POST['tag'];
		$query = "SELECT tag_title FROM tags WHERE tag_title LIKE '%" . $var . "%' LIMIT 10;";
	}	else {
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
