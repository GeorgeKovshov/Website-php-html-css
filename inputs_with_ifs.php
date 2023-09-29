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
		if($type_input == "Designer"){
			echo '
				<div class="box-input">
					<h3> Input a person</h3>
					<form action="includes/input_designer.inc.php" method = "post">
						<input type="text" name="full_name" placeholder="Full name"><br>
						<span style="font-size:16px;"> Country: </span>'; nations_select($pdo);
			 
			echo '			
						<input type="date" name="birthday" placeholder="Birthday"><br>
						<input type="date" name="deceased" placeholder="deceased"><br>
						<input type="radio" name="gender" id="gender" value="Male" />
						<label for="gender" style="font-size:16px;" >Male</label><br>

						<input type="radio" name="gender" id="gender" value="Female" />
						<label for="gender" style="font-size:16px;" >Female</label><br>
						
						<input type="radio" name="gender" id="gender" value="Other" />
						<label for="gender" style="font-size:16px;" >Other</label><br>
						
						<button> Submit </button>
					</form>
				</div>';
		}
			
		if($type_input == "Company"){
			echo '
			<div class="box-input">
				<h3> Input a company</h3>
				<form action="includes/input_company.inc.php" method = "post">
			
				';
			company_inputs($pdo);
			echo ' 
				<button> Submit </button> 
				</form>
			</div>';}
			
		if($type_input == "Platform"){	
			echo '	
			
			<div class="box-input">
				<h3> Input a platform</h3>
				<form action="includes/input_platform.inc.php" method = "post">
					<input type="text" name="platform_name" placeholder="Platform title"><br>
					<span style="font-size:16px;"> Generation: </span>'; generation_select($pdo); echo '<br>
					
					<span style="font-size:16px;"> Company: </span>'; company_select($pdo, 2); echo' <br>
					<span style="font-size:16px;"> Released: </span> <input type="date" name="released"><br>
					<span style="font-size:16px;"> Discontinued*: </span> <input type="date" name="discontinued"><br>
					<label for="discontinued" style="font-size:16px;" >*leave empty if not discontinued</label><br>
					
					<button> Submit </button>
				</form>
			</div>';
		}	
		if($type_input == "Genre"){
			echo '
			<div class="box-input">
				<h3> Input a genre</h3>
				<form action="includes/input_genre.inc.php" method = "post">
					<input type="text" name="genre_name" placeholder="Name of the Genre">
					<span style="font-size:16px;"> Subgenre of: </span>';  genre_select($pdo,$_SESSION["subgenre_amount"]); echo ' <br>
					
					<textarea name="genre_description" placeholder="genre_description" rows="4" cols="50">Write a description of the genre... </textarea><br>
					
					
					<button> Submit </button>
				</form>
			</div>';
		}
		if($type_input == "Profession"){	
			echo '	
			<div class="box-input">
				<h3> Input a profession</h3>
				<form action="includes/input_profession.inc.php" method = "post">
					<input type="text" name="title" placeholder="Profession title"><br>
					
					<textarea name="profession_description" placeholder="profession_description" rows="4" cols="50">Write a description of the genre... </textarea><br>
					
					<button> Submit </button>
				</form>
			</div>';
		}
		if($type_input == "Tag"){	
			echo '	
			<div class="box-input">
				<h3> Input a tag</h3>
				<form action="includes/input_tag.inc.php" method = "post">
					<input type="text" name="tag_title" placeholder="Enter a #tag"><br>
					
					
					
					<button> Submit </button>
				</form>
			</div>';
		}
		if($type_input == "Genre"){
			echo '
			<form action="./includes/variable_increase_small.inc.php" style="width: 300px" method = "post">
				<br>
					Change "subgenre" amount:
				
				<button name="+1" style="padding:2px 5px;"> + </button>
				<button name="-1" style="padding:2px 7px;"> - </button>
			
				<br>
		
			</form>';
		}
		
		
		echo '	
		</div> 
		<div class="container-input">';
			 check_input_errors(); echo '
		</div>
		
</body>

</html>
'; ?>