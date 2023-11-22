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
		<title>Great Games Base</title>
		
</head>

<body>
		<h3> 
		<?php 
				
				if(!isset($_SESSION["image_amount"])){
					$_SESSION["image_amount"] = 1;
				}
				
				
		/*
			if(isset($_SESSION["user_id"])){
				echo "You are logged in as " . $_SESSION["user_username"];
			} else {
				echo "You are not logged in";<form action="includes/input_designer.inc.php" method = "post">
			}*/
		?>
		</h3>
		<script>
			if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
			}
		</script>
								
									
		<div class="container-input">
			<form class="form-input" action="includes/input_game.inc.php" method = "post" enctype="multipart/form-data"> 
			
			
			
				<div class="box-input">
					<div class="form-input">
						<div style="grid-row: 1 /5"> 
							<h3> Input a game</h3>
							<!--
							<input type="text" name="game_title" placeholder="Game title"> 
							<input type="text" name="series_title" placeholder="Series"><br>
							<span style="font-size:16px;"> Date of Release: </span> <br> <input type="date" name="released"> <br> -->
							<?php game_inputs($pdo); ?>
							<span style="font-size:16px;"> Developer: </span> 
							<div id="developer_big_selector_div"></div>
							<span style="font-size:16px;"> Publisher: </span> <br>
							<div id="company_big_selector_div"></div>
							
						</div>
						
						<div class="game_input_boxes">
							<span style="font-size:16px;"> Genres: </span> 
							<span style="font-size:16px; padding-left: 10px;"> Platforms: </span>
							
							<div id="subgenre_big_selector_div" style="padding-right: 10px;"></div>
						
							<div id="platform_big_selector_div"></div>
							
						</div>
						<br>
						
					
						<div class="game_input_boxes">
	
								<span style="font-size:16px;"> Designers: </span> 
								<span style="font-size:16px; justify-self: start;">  Roles: </span>
								<div id="designer_big_selector_div"></div>
								<div id="profession_big_selector_div"></div>
								
							
							
						</div>
						
						
						<div style="grid-column-end: span 3;">
						<br>
							<?php 
								//<textarea  name="game_description" placeholder="game_description" rows="4" cols="50">Write a description of the game... </textarea><br>
								if(isset($_SESSION["input_data"]["game_description"])){
									echo '
											<textarea  name="game_description" placeholder="Game description" rows="4" cols="50">' . $_SESSION["input_data"]["game_description"] . '</textarea><br>';
								} else {
									echo '
											<textarea  name="game_description" placeholder="Game description" rows="4" cols="50">Write a description of the game... </textarea><br>';
								}
							
							?>
							
							<span style="font-size:16px;"> Tags: </span> 
								<div id="tag_big_selector_div"></div>
							<br><span> Score: 
							<?php 
								if(isset($_SESSION["input_data"]["score"])){
									score_select((int)$_SESSION["input_data"]["score"]); 
								}else {
									score_select(0);
								}
								
							?> 
							</span><button> Submit </button>
							
						</div>
						<div class="box-input" style="width:300px;">
						
						
							<span> Upload Cover:</span> <input type="file" name="cover_image" id="cover_image">
							<br>
							<span> Upload Screenshots:</span> 
							<?php
							$i = $_SESSION["image_amount"];
							while($i>0){
								echo '<input type="file" name="screenshot' . $i .  '" id="screenshot">';
								$i--;
							}
						
							?>
							<br>	
						</div>	
					</div>
				</div>
			
					
				
			</form>
			
			<form action="./includes/variable_increase.inc.php" style="width: 300px" method = "post">
			<br>

			Change "screenshots" amount:
			
			<button name="+4" style="padding:2px 5px;"> + </button>
			<button name="-4" style="padding:2px 7px;"> - </button>
		
			<br>

			</form>
			
		</div>
		</div> 
		<div class="container-input">
			<?php check_input_errors();?>
		</div>
		

<?php 
	$session_variables = [
		$_SESSION["input_data"]["designer_game"],
		$_SESSION["input_data"]["developer_game"],
		$_SESSION["input_data"]["company_game"],
		$_SESSION["input_data"]["genre_game"],
		$_SESSION["input_data"]["platform_game"],
		$_SESSION["input_data"]["tags_game"]
	];
	echo '<script>'; echo 'let session_vars ='; echo json_encode($session_variables); echo '</script>';
	create_datalist($pdo, ["designer_many", "developer_single", "company_single", "subgenre_many", "platform_many", "tag_many"]); 	
	
?>

<?php	
	$array = get_professions($pdo);
	echo '<script>';
	echo 'let professions ='; echo json_encode($array); 
	echo '</script>';
	echo '<script>';
	echo 'let set_professions =';
	if(isset($_SESSION["input_data"]["profession_game"])){
		echo json_encode($_SESSION["input_data"]["profession_game"]);
	} else {
		echo "''";
	}
	echo '</script>';
?>
	
<script src="includes/java_tie_profession_to_designers.inc.js"></script>

			
			

</body>

</html>