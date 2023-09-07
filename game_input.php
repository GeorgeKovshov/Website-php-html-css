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
		/*
			if(isset($_SESSION["user_id"])){
				echo "You are logged in as " . $_SESSION["user_username"];
			} else {
				echo "You are not logged in";<form action="includes/input_designer.inc.php" method = "post">
			}*/
		?>
		</h3>
		
		<div class="container-input">
			<form class="form-input" action="includes/input_game.inc.php"method = "post"> 
				<div class="box-input">
					<div class="form-input" >
						<div> 
							<h3> Input a game</h3>
							<input type="text" name="game_title" placeholder="Game title"> 
							<input type="text" name="series_title" placeholder="Series"><br>
							<span style="font-size:16px;"> Date of Release: </span> <br> <input type="date" name="released">
							<span style="font-size:16px;"> Developer: </span> <?php company_select($pdo, 1); ?><br>
							<span style="font-size:16px;"> Publisher: </span> <?php company_select($pdo, 2); ?><br>
							
						</div>
						
						<div>
							<br> 
							<span style="font-size:16px;"> Genres: </span> 
							
							<?php 
								echo "<br>"; genre_select($pdo,3); 
								//echo "<br>"; genre_select($pdo);
								//echo "<br>"; genre_select($pdo);
							?>
							<span style="font-size:16px;"> Designers:  
								<?php 
								designer_select($pdo,3); 
								///designer_select($pdo);
								//designer_select($pdo);
								?> 
							</span><br>
						</div>
						
						<div>
							<br> 
							<span style="font-size:16px;"> Platforms: </span> 
							<?php 
								echo "<br>"; platform_select($pdo,3); 
								//echo "<br>"; platform_select($pdo);
								//echo "<br>"; platform_select($pdo);
							?>
						
						</div>
						
						
						
						<div style="grid-column-end: span 3;">
							<textarea  name="game_description" placeholder="game_description" rows="4" cols="50">Write a description of the game... </textarea><br>
							<span style="font-size:16px;"> Tags: </span> 
							<?php 
								 //platform_select($pdo); 
								 ///platform_select($pdo);
								 //platform_select($pdo);
							?>
							<br><span> Score: <?php score_select(); ?> </span>
							<button> Submit </button>
						</div>
					</div>
				</div>
				<div class="box-input">
					
				</div>
			</form>
		
		</div> 
		<div class="container-input">
			<?php check_input_errors(); ?>
		</div>
		

		
		

			
			

</body>

</html>