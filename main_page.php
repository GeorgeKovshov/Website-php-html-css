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
<html>
	<head>
	
		<meta charset="UTF-8">
		<meta name="description" content="This is website">
		<link rel="stylesheet" type="text/css" href="CSS/style.css">
		<title> Great Games </title>
	</head>
	
		
	<body>
		<div class="box-1"  style="position: sticky; top:0px;">
			fuck
			<hr>
			</div>
		<div class="container_new">
			
		<?php  		
					$gamess = array_reverse(get_games($pdo));
					//$gamess = ["sssss", "test","Phantasmagoria 2: A Puzzle of Flesh", "Metal Gear Solid", "Earthworm Jim"];
					foreach($gamess as $gam){
						
					$result = get_game($pdo, $gam);
				
				?>
			<div class="box-1_new">
				
				
				<div>
					<img height="250" src="includes/<?php echo $result["cover"]; ?>" alt="a really informative image"/><br>
				</div>
				
				<div class="box-input_new">
					<h1 class="box-input_new"><?php echo $result["game_title"]; ?></h1>
					<p>	
						Platforms: <?php print_array($result["platforms"]);?>
					</p>
					<p>	
						Genres: <?php print_array($result["genres"]);?>
					</p>
					
					<p><?php echo "Released: " . date("Y, F jS", strtotime($result["release_date"])); ?></p>

					<p><?php echo "Developer: " . $result["developer"];?></p>
					<p><?php echo "Publisher: " . $result["publisher"];?></p>
				</div>		
				
				
				
							
				
			</div>
					<?php } ?>
		</div>
		
	</body>

</html>