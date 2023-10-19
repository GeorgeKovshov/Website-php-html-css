<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$full_name = $_POST["full_name"];
	$nationality = $_POST["country"]; 
	$birthday = $_POST["birthday"];
	$deceased = $_POST["deceased"];
	$gender = $_POST["gender"];
	
	try{
		require_once "./dbh_games.inc.php";
		require_once "./ggb_model.inc.php"; 
		require_once "./ggb_contr.inc.php";
		
		// ERROR HANDLERS
		$errors = [];
		
		$arr = [$full_name, $nationality, $gender];
		if(is_input_empty($arr)){
			$errors["empty_input"] = "Fill in all fields!";
		}
		
		/////$name = get_name($pdo, $fullname);
		
		if(is_name_taken($pdo, $full_name, "full_name", "people" )){
			$errors["full_name_taken"] = "This person was already added!";
		}
		if(empty($birthday)){
			$birthday = "Unknown";
		}
		if(empty($deceased )){
			$deceased = "Unknown";
		}
		

		require_once "config_session.inc.php";
		
		
		if($errors){
			$_SESSION["errors_input"] = $errors;
			$inputData = [
				"full_name" => $full_name,
				"nationality" => $nationality, 
				"birthday" => $birthday,
				"deceased" => $deceased,
				"gender" => $gender 
			];
			$_SESSION["input_data"] = $inputData;
			
			$pdo = null;
			header("Location: ../main_page.php?input=failed");
			die();
		}	

		
		input_designer($pdo, $full_name, $nationality, $birthday, $gender, $deceased);

		
		$pdo = null;
		header("Location: ../main_page.php?input=success");
		die();
		
	} catch(PDOException $e) {
		die("Query failed: " . $e->getMessage());
	}
	header("Location: ../main_page.php");
	die();
	
	
}
else{

	header("Location: ../main_page.php");
	die();
}