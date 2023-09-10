<?php
///if($_SERVER["REQUEST_METHOD"] == "POST"){
	$target_dir = "covers/";
	$files = [];
	//$target_file = $target_dir . basename($_FILES["cover_image"]["name"]);
	$uploadOk = 1;
	//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	
	$i = 1;
	while(isset($_FILES["cover_image" . $i]["name"])){
		array_push($files, $target_dir . basename($_FILES["cover_image" . $i]["name"]));
		$i++;
	}

	try{
		require_once "./dbh_games.inc.php";
		require_once "./ggb_model.inc.php"; 
		require_once "./ggb_contr.inc.php";
		$i = 1;
		
		foreach($files as $target_file){
			
			
			// ERROR HANDLERS
			$errors = [];
			
			if($target_file == $target_dir){
				$i++;
				continue;
			}
			
			// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["cover_image" . $i]["tmp_name"]);
			if($check == false) {
				$errors["not_image"] = " $target_file File is not an image.";
			}
			
			// Check if file already exists
			if (file_exists($target_file)) {
			  $errors["image_exists"] = "Cover was already added!";
			}
			
			// Check file size
			if ($_FILES["cover_image" . $i]["size"] > 1000000) {
			  $errors["image_too_big"] = "Image is too big!";
			}
			
			// Allow certain file formats
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif") {
			  $errors["wrong_file_extension"] = "Only JPG, JPEG, PNG, WEBP & GIF files are allowed!";
			}
			
			

			require_once "config_session.inc.php";
			
			
			if($errors){
				$_SESSION["errors_input"] = $errors;
				//storing correct info to fill in when reset

				
				$pdo = null;
				header("Location: ../test_stuff.php");
				die();
			}	
					
			$sql = "INSERT INTO screenshots(screenshot_path, game_id) VALUES (:filename, 1)";
		

			$stmt = $pdo->prepare($sql);

		
			$stmt->bindParam(":filename", $_FILES["cover_image" . $i]["name"]);
			$stmt->execute();
			$stmt = null;
			move_uploaded_file($_FILES["cover_image" . $i]["tmp_name"], $target_file);
			
			$i++;
			
		}
		/*
		if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file)) {
			$pdo = null;
			header("Location: ../test_stuff.php?input=success");
			
		} else {
			$pdo = null;
			header("Location: ../test_stuff.php?input=failure");
		}*/
		$pdo = null;
		header("Location: ../test_stuff.php");
		die();

		
	} catch(PDOException $e) {
		die("Query failed: " . $e->getMessage());
	}
	header("Location: ../test_stuff.php");
	die();
	
	
///}
//else{

//	header("Location: ../test_stuff.php");
//	die();
//}