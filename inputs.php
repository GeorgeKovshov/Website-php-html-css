<!DOCTYPE html>
<html lang="en">

<?php
require_once 'includes/config_session.inc.php';
//require_once 'includes/signup_view.inc.php';
//require_once 'includes/login_view.inc.php';

require_once "includes/dbh_games.inc.php";
require_once "includes/ggb_model.inc.php"; 
require_once "includes/ggb_contr.inc.php";
require_once 'includes/ggb_view.inc.php';
?>



<head>

		<meta charset="UTF-8">
		
		<link rel="stylesheet" type="text/css" href="CSS/style.css">
		<!--  <meta name="viewport" content="width=device-width, initial-->
		<title>Water deals</title>
		
</head>

<body>
		<?php 
				if(!isset($_SESSION["subgenre_amount"])){
					$_SESSION["subgenre_amount"] = 1;
				}
		?>
		<h3> 
		<?php
			$type_input =filter_input(INPUT_GET, 'input', FILTER_SANITIZE_URL);
		/*
			if(isset($_SESSION["user_id"])){
				echo "You are logged in as " . $_SESSION["user_username"];
			} else {
				echo "You are not logged in";<form action="includes/input_designer.inc.php" method = "post">
			}*/
		
		echo '
			</h3>
			
			<div class="container-input">';
		switch($type_input){
			
		case "Designer":
			designer_inputs($pdo);
			break;
		case "Company":
			company_inputs($pdo);
			break;
		case "Platform":	
			platform_inputs($pdo);
			break;
		case "Genre":
			genre_inputs($pdo);
			break;
		case "Profession":
			profession_inputs($pdo);
			break;
		case "Tag":	
			tag_inputs($pdo);
			break;
		default: 
			header("Location: ../main_page.php?input=wrong_type");
			die();
		}
			
		/*
		function genre_select(object $pdo, int $amount){
			$array = get_genres($pdo);
			while($amount > 0){
				echo '<select name="subgenre'. $amount .'" id="subgenre">';
				echo '<option value=0> None </option>'; 
				foreach($array as $key => $value) { 
					echo '<option value=' . $key . '>' . $value . "</option>"; 
				} 
				echo '</select>';
				$amount--;
			}
			
			
		}
		
		*/
			
			
		if($type_input == "Genre"){
			$array = get_genres($pdo);
			if(isset($_SESSION["input_data"]["subgenres"])){
				echo '<script>'; echo 'let subgenres ='; echo json_encode($_SESSION["input_data"]["subgenres"]); echo '</script>';
			} else {
				echo '<script>'; echo 'let subgenres ="empty"'; echo '</script>';
			}
			echo '<script>'; echo 'let genres ='; echo json_encode($array); echo '</script>';
			echo '<script src="includes/java_genre.inc.js">';			
			echo '</script>';
		}
		else if($type_input == "Platform"){
			echo '<script src="includes/java_platform.inc.js">';			
			echo '</script>';
		}
		/*	
		echo '<div id="java_genre">';
		if($type_input == "Genre"){
			echo '
			<form action="./includes/variable_increase_small.inc.php" style="width: 300px" method = "post">
				<br>
					Change "subgenre" amount:
				
				<button name="+1" style="padding:2px 5px;"> + </button>
				<button name="-1" style="padding:2px 7px;"> - </button>
			
				<br>
		
			</form>';
		}*/
		
		
		echo '	
		</div> 
		<div class="container-input">';
			 check_input_errors(); echo '
		</div>
		
</body>

</html>
'; ?>