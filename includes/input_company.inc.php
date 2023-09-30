<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$company_name = $_POST["company_name"];
	$company_type = $_POST["company_type"];
	$country = $_POST["country"];
	$founded = $_POST["founded"];
	$closed = $_POST["closed"];

	try{
		require_once "./dbh_games.inc.php";
		require_once "./ggb_model.inc.php"; 
		require_once "./ggb_contr.inc.php";
		
		// ERROR HANDLERS
		$errors = [];
		
		$arr = [$company_name, $company_type, $founded];
		if(is_input_empty($arr)){
			$errors["empty_input"] = "Fill in all the necessary data!";
		}
		else {
			if(is_name_taken($pdo, $company_name, "title", $company_type )){
			$errors["company_name_taken"] = "This $company_type was already added!";
			}
			
		}
		
		
		
		/////$name = get_name($pdo, $fullname);
		
		
		
		
		/*
		if(is_username_wrong($result)){
			$errors["login_incorrect"] = "Incorrect login info!";
		}
		if(!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])){
			$errors["login_incorrect"] = "Incorrect login info!";
		}
		
		if(is_input_empty($username, $pwd, $email)){
			$errors["empty_input"] = "Fill in all fields!";
		}
		if(is_email_invalid($email)){
			$errors["invalid_email"] = "Invalid email used!";
		}
		
		if(is_email_registered($pdo, $email)){
			$errors["email_used"] = "Email already registered!";
			
		}
		
		*/
		require_once "config_session.inc.php";
		
		
		if($errors){
			$_SESSION["errors_input"] = $errors;
			//storing correct info to fill in when reset
			$inputData =[
				"company_name" => $company_name,
				"company_type" => $company_type,
				"country" => $country,
				"founded" => $founded,
				"closed" => $closed
			];
			$_SESSION["input_data"] = $inputData;
			
			$pdo = null;
			header("Location: ../main_page.php");
			die();
		}	
				
		
		if(empty($closed)){
			$closed = "1";
		}
		input_company($pdo, $company_name, $country, $company_type, $founded, $closed);

		
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