<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$tag_title = $_POST["tag_title"];

	try{
		require_once "./dbh_games.inc.php";
		require_once "./ggb_model.inc.php"; 
		require_once "./ggb_contr.inc.php";
		
		// ERROR HANDLERS
		$errors = [];
		
		$arr = [$tag_title];
		if(is_input_empty($arr)){
			$errors["empty_input"] = "Fill in all the necessary data!";
		}
		else {
			if(is_name_taken($pdo, $tag_title, "tag_title", "tags" )){
			$errors["tag_name_taken"] = "This tag was already added!";
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
				
		
		
		input_tag($pdo, $tag_title);

		
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