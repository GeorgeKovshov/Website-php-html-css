<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$genre_name = $_POST["genre_name"];
	$genre_description = $_POST["genre_description"];
	$subgenre= array();
	
	$i = 1;
	while(isset($_POST['subgenre' . $i])){
		array_push($subgenre, $_POST['subgenre' . $i]);
		$i++;
	}
	

	try{
		require_once "./dbh_games.inc.php";
		require_once "./ggb_model.inc.php"; 
		require_once "./ggb_contr.inc.php";
		
		// ERROR HANDLERS
		$errors = [];
		
		$arr = [$genre_name, $genre_description];
		if(is_input_empty($arr)){
			$errors["empty_input"] = "$subgenre[0] Fill in all the necessary data!";
		}
		else {
			if(is_name_taken($pdo, $genre_name, "genre_name", "genre" )){
			$errors["genre_name_taken"] = "This genre was already added!";
			}
			
		}
		
		$filename ='genre_descriptions/' . $genre_name . '_desc.txt';
		if(!file_put_contents($filename, $genre_description)){
			$errors["failed_description"] = "Failed to upload description!";
		}
		

		require_once "config_session.inc.php";
		
		
		if($errors){
			$_SESSION["errors_input"] = $errors;
			//storing correct info to fill in when reset
			//storing correct info to fill in when reset
			$inputData =[
				"genre_name" => $genre_name,
				"genre_description" => $genre_description,
				"subgenres" => $subgenre 
			];
			$_SESSION["input_data"] = $inputData;
			
			$pdo = null;
			header("Location: ../inputs.php?input=Genre&upload=failed");
			die();
		}	
				
		
		if(empty($subgenre)){
			$subgenre = "1";
		}
		input_genre($pdo, $genre_name, $filename, $subgenre);

		
		$pdo = null;
		header("Location: ../inputs.php?input=Genre&upload=success");
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