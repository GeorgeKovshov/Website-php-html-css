<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$genre_name = $_POST["genre_name"];
	$genre_description = $_POST["genre_description"];
	$subgenre= $_POST["subgenre"];

	try{
		require_once "./dbh_games.inc.php";
		require_once "./ggb_model.inc.php"; 
		require_once "./ggb_contr.inc.php";
		
		// ERROR HANDLERS
		$errors = [];
		
		$arr = [$genre_name, $genre_description];
		if(is_input_empty($arr)){
			$errors["empty_input"] = "Fill in all the necessary data!";
		}
		else {
			if(is_name_taken($pdo, $genre_name, "genre_name", "genre" )){
			$errors["genre_name_taken"] = "This genre was already added!";
			}
			
		}
		

		require_once "config_session.inc.php";
		
		
		if($errors){
			$_SESSION["errors_input"] = $errors;
			//storing correct info to fill in when reset

			
			$pdo = null;
			header("Location: ../test_input.php");
			die();
		}	
				
		

		input_genre($pdo, $genre_name, $genre_description, $subgenre);

		
		$pdo = null;
		header("Location: ../test_input.php?input=success");
		die();
		
	} catch(PDOException $e) {
		die("Query failed: " . $e->getMessage());
	}
	header("Location: ../test_input.php");
	die();
	
	
}
else{

	header("Location: ../test_input.php");
	die();
}