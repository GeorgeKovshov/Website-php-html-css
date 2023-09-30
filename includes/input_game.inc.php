<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$covers_dir = "covers/";
	$screenshots_dir = "screenshots/";
	$files = [];
	
	$game_title = $_POST["game_title"];
	$series_title = $_POST["series_title"];
	$released = $_POST["released"];
	$developer = $_POST["developer"];
	$publisher = $_POST["company"];
	///$cover = $_POST["cover_image"];
	
	$genre = [];
	$designer = [];
	$profession = [];
	$platform = [];
	$tags = [];
	$screenshots = [];
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
	while(isset($_POST['profession' . $i])){
		array_push($profession, $_POST['profession' . $i]);
		$i++;
	}
	$i = 1;
	while(isset($_POST['platform' . $i])){
		array_push($platform, $_POST['platform' . $i]);
		$i++;
	}
	$i = 1;
	while(isset($_POST['tag' . $i])){
		array_push($tags, $_POST['tag' . $i]);
		$i++;
	}
	
	array_push($files, $covers_dir . basename($_FILES["cover_image"]["name"]));
	$i = 1;
	while(isset($_FILES["screenshot" . $i]["name"])){
		array_push($files, $screenshots_dir . basename($_FILES["screenshot" . $i]["name"]));
		$i++;
	}

	
	
	$score = $_POST["score"];
	$game_description = $_POST["game_description"];

	try{
		require_once "./dbh_games.inc.php";
		require_once "./ggb_model.inc.php"; 
		require_once "./ggb_contr.inc.php";
		
		// ERROR HANDLERS
		$errors = [];
		
		$filename ='game_descriptions/' . $game_title . '_desc.txt';
		if(!file_put_contents($filename, $game_description)){
			$errors["failed_description"] = "Failed to upload description!";
		}
		
		
		
		/*$j = 1;
		foreach($tags as $value){
				$errors["platform" . $j] = "platfofffff" . $j . ": " . $value;
				$j++;
			}*/
		$arr = [$game_title, $released, $developer, $publisher, $genre, $platform, $score];
		if(is_zero_input($platform) || is_zero_input($genre)){
			
			
			$errors["zero_input"] = "Select at least one genre and platform! ";
		}
		
		if(is_zero_input([$developer]) || is_zero_input([$publisher])){
			$errors["zero_input1"] = "Select a developer and publisher! ";
			
			
			$errors["ssss"] = $designer;
		}
		
		if(is_input_empty($arr)){
			$errors["empty_input"] = "Fill in all the necessary data! ";
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
		
		//IMAGES ERROR HANDLING
		
		$i = 0;
		
		foreach($files as $target_file){
			
			
			// ERROR HANDLERS
			
			if($target_file == $screenshots_dir || $target_file == $covers_dir ){
				$i++;
				continue;
			}
			
			if($i == 0) {
				$file_name = "cover_image";
			}
			else{
				$file_name = "screenshot" . $i;
			}
				
			// Check file size
			if ($_FILES[$file_name]["size"] > 5000000) {
				$errors["image_too_big"] = "Image is too big!";
			}
			// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES[$file_name]["tmp_name"]);
			if($check == false) {
				$errors["not_image"] = " $target_file File is not an image.";
			}
			
			// Check if file already exists
			if (file_exists($target_file)) {
			  $errors["image_exists"] = "$target_file was already added!";
			}
			
			
			
			// Allow certain file formats
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif") {
			  $errors["wrong_file_extension"] = "Only JPG, JPEG, PNG, WEBP & GIF files are allowed!";
			}
			
			if($errors){
				$_SESSION["errors_input"] = $errors;
				//storing correct info to fill in when reset

				
				$pdo = null;
				header("Location: ../game_input.php");
				die();
			}	
			
			if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
				//echo "The file has been uploaded.";
			} else {
				$errors["failed_uploading_image"] = "The image failed to upload!";
			}
			
			$i++;
			
		}
		
		
		
		
		
		
		
		if($errors){
			$_SESSION["errors_input"] = $errors;
			//storing correct info to fill in when reset

			
			$pdo = null;
			header("Location: ../game_input.php");
			die();
		}	
				
		

		input_game($pdo, $game_title, $series_title, $released, $developer, $publisher, $genre, $designer, $profession, $platform, $score, $filename, $tags, $files);

		
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