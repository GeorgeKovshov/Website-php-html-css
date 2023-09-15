<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$title = $_POST["title"];
	$profession_description = $_POST["profession_description"];

	try{
		require_once "./dbh_games.inc.php";
		require_once "./ggb_model.inc.php"; 
		require_once "./ggb_contr.inc.php";
		
		// ERROR HANDLERS
		$errors = [];
		
		$arr = [$title, $profession_description];
		if(is_input_empty($arr)){
			$errors["empty_input"] = "Fill in all the necessary data!";
		}
		else {
			if(is_name_taken($pdo, $title, "title", "profession" )){
			$errors["profession_name_taken"] = "This profession was already added!";
			}
			
		}
		
		$filename ='profession_descriptions/' . $title . '_desc.txt';
		if(!file_put_contents($filename, $profession_description)){
			$errors["failed_description"] = "Failed to upload description!";
		}
		

		require_once "config_session.inc.php";
		
		
		if($errors){
			$_SESSION["errors_input"] = $errors;
			//storing correct info to fill in when reset

			
			$pdo = null;
			header("Location: ../test_input.php");
			die();
		}	
				
		
		
		input_profession($pdo, $title, $filename);

		
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