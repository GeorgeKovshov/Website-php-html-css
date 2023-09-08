<?php



if($_SERVER["REQUEST_METHOD"] == "POST"){
	require_once 'config_session.inc.php';
	if(isset($_POST['+'])){
		$_SESSION["j"] = $_SESSION["j"] + 1;
	}
	else if(isset($_POST['-'])){
		$_SESSION["j"] = $_SESSION["j"] - 1;
	}
	
}
header("Location: ../test_stuff.php");
?>