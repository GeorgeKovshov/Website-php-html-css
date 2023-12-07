<?php



if($_SERVER["REQUEST_METHOD"] == "POST"){
	require_once 'config_session.inc.php';
	if(isset($_POST['+1'])){
		$_SESSION["genre_amount"] = $_SESSION["genre_amount"] + 1;
	}
	else if(isset($_POST['-1'])){
		$_SESSION["genre_amount"] = $_SESSION["genre_amount"] - 1;
	}
	
	if(isset($_POST['+2'])){
		$_SESSION["designer_amount"] = $_SESSION["designer_amount"] + 1;
	}
	else if(isset($_POST['-2'])){
		$_SESSION["designer_amount"] = $_SESSION["designer_amount"] - 1;
	}
	
	if(isset($_POST['+3'])){
		$_SESSION["platform_amount"] = $_SESSION["platform_amount"] + 1;
	}
	else if(isset($_POST['-3'])){
		$_SESSION["platform_amount"] = $_SESSION["platform_amount"] - 1;
	}
	
	if(isset($_POST['+4'])){
		$_SESSION["image_amount"] = $_SESSION["image_amount"] + 1;
	}
	else if(isset($_POST['-4'])){
		$_SESSION["image_amount"] = $_SESSION["image_amount"] - 1;
	}
	
	if(isset($_POST['+5'])){
		$_SESSION["tags_amount"] = $_SESSION["tags_amount"] + 1;
	}
	else if(isset($_POST['-5'])){
		$_SESSION["tags_amount"] = $_SESSION["tags_amount"] - 1;
	}
}
header("Location: ../game_input.php");
?>