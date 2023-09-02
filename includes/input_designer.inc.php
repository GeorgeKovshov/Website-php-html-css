<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$full_name = $_POST["full_name"];
	$nationality = $_POST["country"]; 
	$birthday = $_POST["birthday"];
	$gender = $_POST["gender"];
	
	try{
		require_once "./dbh_games.inc.php";
		require_once "./ggb_model.inc.php"; 
		require_once "./ggb_contr.inc.php";
		
		// ERROR HANDLERS
		$errors = [];
		
		$arr = [$full_name, $nationality, $birthday, $gender];
		if(is_input_empty($arr)){
			$errors["empty_input"] = "Fill in all fields!";
		}
		
		/////$name = get_name($pdo, $fullname);
		
		if(is_name_taken($pdo, $full_name, "full_name", "people" )){
			$errors["full_name_taken"] = "This person was already added!";
		}
		
		
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
			
			
			$pdo = null;
			header("Location: ../test_input.php?input=failed");
			die();
		}	
		/*
		$newSessionId = session_create_id();
		$sessionId = $newSessionId . "_" . $result["id"];
		session_id($session_id);
		
		$_SESSION["user_id"] = $result["id"];
		$_SESSION["user_username"] = htmlspecialchars($result["username"]);
		$_SESSION["last_regeneration"] = time();**/
		
		input_designer($pdo, $full_name, $nationality, $birthday, $gender);

		
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