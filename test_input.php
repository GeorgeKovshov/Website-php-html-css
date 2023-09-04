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
			<div class="box-input">
				<h3> Input a game</h3>
				<form action="includes/input_game.inc.php" method = "post">
					<input type="text" name="game_title" placeholder="Game title"><br>
					
					<span style="font-size:16px;"> Genre: </span> <?php genre_select($pdo); ?><br>
					<span style="font-size:16px;"> Released: </span> <input type="date" name="released"><br>
					
					<textarea name="genre_description" placeholder="genre_description" rows="4" cols="50">Write a description of the genre... </textarea><br>
					
					
					<button> Submit </button>
				</form>
			</div>
		
			<div class="box-input">
				<h3> Input a person</h3>
				<form action="includes/input_designer.inc.php" method = "post">
					<input type="text" name="full_name" placeholder="Full name"><br>
					<span style="font-size:16px;"> Country: </span> <?php nations_select($pdo); ?><br>
					
					<input type="date" name="created" placeholder="Birthday"><br>
					<input type="radio" name="gender" id="gender" value="Male" />
					<label for="gender" style="font-size:16px;" >Male</label><br>

					<input type="radio" name="gender" id="gender" value="Female" />
					<label for="gender" style="font-size:16px;" >Female</label><br>
					
					<input type="radio" name="gender" id="gender" value="Other" />
					<label for="gender" style="font-size:16px;" >Other</label><br>
					
					<button> Submit </button>
				</form>
			</div>
			
			<?php
			
				//$gender = $_POST["gender"];echo $gender; 
				//$nationality = $_POST["nationality"];echo $nationality;
				//nations_select($pdo);
				/*
				
				$date = DateTime::createFromFormat('m-d-Y', $birthday)->format('F j, Y');
				$output = $date->format('F j, Y');
				echo $output;*/
				
				
				
				
				//$pdo = null;
			?>
			<div class="box-input">
				<h3> Input a company</h3>
				<form action="includes/input_company.inc.php" method = "post">
				<!-- 	<input type="text" name="company_name" placeholder="Name of the company"><br>
					<span style="font-size:16px;"> Country: </span> <?php ///nations_select($pdo); ?><br>
					
					
					
					<input type="radio" name="company_type" id="type" value="developer" />
					<label for="type" style="font-size:16px;" >Developer</label><br>

					<input type="radio" name="company_type" id="type" value="publisher" />
					<label for="type" style="font-size:16px;" >Publisher</label><br>
					<span style="font-size:16px;"> Founded: </span> <input type="date" name="founded"><br>
					<span style="font-size:16px;"> Closed: </span> <input type="date" name="closed"><br>
					<label for="closed" style="font-size:16px;" >*leave empty if not closed</label><br>

					
					
				 -->
				
				<?php company_inputs($pdo); ?>
				<button> Submit </button> 
				</form>
			</div>
			
			<div class="box-input">
				<h3> Input a platform</h3>
				<form action="includes/input_platform.inc.php" method = "post">
					<input type="text" name="platform_name" placeholder="Platform title"><br>
					<span style="font-size:16px;"> Generation: </span> <?php generation_select($pdo); ?><br>
					
					<span style="font-size:16px;"> Company: </span> <?php company_select($pdo); ?><br>
					<span style="font-size:16px;"> Released: </span> <input type="date" name="released"><br>
					<span style="font-size:16px;"> Discontinued*: </span> <input type="date" name="discontinued"><br>
					<label for="discontinued" style="font-size:16px;" >*leave empty if not discontinued</label><br>
					
					<button> Submit </button>
				</form>
			</div>
			
			
			<div class="box-input">
				<h3> Input a genre</h3>
				<form action="includes/input_genre.inc.php" method = "post">
					<input type="text" name="genre_name" placeholder="Name of the Genre"><br>
					<span style="font-size:16px;"> Subgenre of: </span> <?php genre_select($pdo); ?><br>
					
					<textarea name="genre_description" placeholder="genre_description" rows="4" cols="50">Write a description of the genre... </textarea><br>
					
					
					<button> Submit </button>
				</form>
			</div>
			
			
		
		
		
		
		
		</div> 
		<div class="container-input">
			<?php check_input_errors(); ?>
		</div>
		
		
		<?php //check_login_errors(); ?>
		
		
		
		<?php
			//check_signup_errors();
		?>
		
		

			
			

</body>

</html>