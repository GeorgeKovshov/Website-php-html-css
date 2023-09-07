<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$game_title = $_POST["game_title"];
	$series_title = $_POST["series_title"];
	$released = $_POST["released"];
	$developer = $_POST["developer"];
	$publisher = $_POST["company"];
	
	$genre = [];
	$designer = [];
	$platform = [];
	$i = 1;
	while(isset($_POST['subgenre' . $i])){
		array_push($genre, $_POST['subgenre' . $i]);
		$i++;
	}
	$i = 1;
	while(isset($_POST['designer' . $i])){
		array_push($designer, $_POST['designer' . $i]);
		$i++;
	}
	$i = 1;
	while(isset($_POST['platform' . $i])){
		array_push($platform, $_POST['platform' . $i]);
		$i++;
	}

	
	$aa = !isset($_POST['subgenre'.'1']);
	
	$score = $_POST["score"];
	$game_description = $_POST["game_description"];

	try{
		require_once "./dbh_games.inc.php";
		require_once "./ggb_model.inc.php"; 
		require_once "./ggb_contr.inc.php";
		
		// ERROR HANDLERS
		$errors = [];
		
		$arr = [$game_title, $series_title, $released, $developer, $publisher, $genre, $platform, $score];
		if(is_input_empty($arr)){
			$errors["empty_input"] = "$genre[0], $genre[1], $genre[2] Fill in all the necessary data! ";
		}
		else {
			if(is_name_taken($pdo, $game_title, "game_title", "games" )){
			$errors["game_name_taken"] = "This game was already added!";
			}
			
		}
		

		require_once "config_session.inc.php";
		
		
		if($errors){
			$_SESSION["errors_input"] = $errors;
			//storing correct info to fill in when reset

			
			$pdo = null;
			header("Location: ../game_input.php");
			die();
		}	
				
		

		///input_game($pdo, $game_title, $series_title, $released, $developer, $publisher, $genre, $designer, $platform, $score, $game_description);

		
		$pdo = null;
		header("Location: ../game_input.php?input=success");
		die();
		
	} catch(PDOException $e) {
		die("Query failed: " . $e->getMessage());
	}
	header("Location: ../game_input.php");
	die();
	
	
}
else{

	header("Location: ../test_input.php");
	die();
}