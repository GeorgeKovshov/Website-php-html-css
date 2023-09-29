<?php



if($_SERVER["REQUEST_METHOD"] == "POST"){
	require_once 'config_session.inc.php';
	if(isset($_POST['+1'])){
		$_SESSION["subgenre_amount"] = $_SESSION["subgenre_amount"] + 1;
	}
	else if(isset($_POST['-1'])){
		$_SESSION["subgenre_amount"] = $_SESSION["subgenre_amount"] - 1;
	}
	
}
header("Location: ../inputs.php?input=Genre");
?>