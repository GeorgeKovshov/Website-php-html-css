<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$platform_name = $_POST["platform_name"];
	$company = $_POST["company"];
	$generation = $_POST["generation"];
	$released = $_POST["released"];
	$discontinued = $_POST["discontinued"];

	try{
		require_once "./dbh_games.inc.php";
		require_once "./ggb_model.inc.php"; 
		require_once "./ggb_contr.inc.php";
		
		// ERROR HANDLERS
		$errors = [];
		
		$arr = [$company, $platform_name, $released];
		if(is_input_empty($arr)){
			$errors["empty_input"] = "Fill in all the necessary data!";
		}
		else {
			if(is_name_taken($pdo, $platform_name, "platform_name", "platform" )){
			$errors["platform_name_taken"] = "This platform was already added!";
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
				
		
		if(empty($discontinued)){
			$discontinued = "1";
		}
		input_platform($pdo, $platform_name, $company, $generation, $released, $discontinued);

		
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