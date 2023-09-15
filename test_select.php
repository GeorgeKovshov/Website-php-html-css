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
<html>
	<head>
	
		<meta charset="UTF-8">
		<meta name="description" content="This is website">
		<link rel="stylesheet" type="text/css" href="CSS/style.css">
		<title> Great Games </title>
	</head>
	
		
	<body>
		
		<div class="container">
		<?php  		
					$gamess = array_reverse(get_games($pdo));
					//$gamess = ["sssss", "test","Phantasmagoria 2: A Puzzle of Flesh", "Metal Gear Solid", "Earthworm Jim"];
					foreach($gamess as $gam){
						
					$result = get_game($pdo, $gam);
				
				?>
			<div class="box-1" style="justify-content: center;">
				
				
				<div>
					<img width="550" src="includes/<?php echo $result["cover"]; ?>" alt="a really informative image"/><br>
				</div>
				
				<div class="box-input">
					<h1><?php echo $result["game_title"]; ?></h1>
					<p>	
						Platforms: <?php print_array($result["platforms"]);?>
					</p>
					<p>	
						Genres: <?php print_array($result["genres"]);?>
					</p>
					
					<p><?php echo "Released: " . date("Y, F jS", strtotime($result["release_date"])); ?></p>
					<p>	
						Designers: <?php show_designers($result["des_pro"]) ?>
					</p>
					<p><?php echo "Developer: " . $result["developer"];?></p>
					<p><?php echo "Publisher: " . $result["publisher"];?></p>
					
					<p> Tags: <?php print_tags($result["tags"]); ?> <p>
					
					
					
				</div>	
				
				<?php //show_screenshots_description($result["screenshots"], $result["game_description"]); ?>
				<div>
					<img height="400" src="includes/<?php echo $result["screenshots"][0]["screenshot_path"]?>" alt="a really informative image"/><br>
				</div>
				<div>
					
					<p><?php show_description($result["game_description"]); ?></p>
					
					<p><?php echo "My score: " . $result["score"] . "/10";?></p>

				</div>
				
				
					<?php show_screenshots($result["screenshots"]); ?>
				
				
				<div>	

				</div>
				
				
							
				
			</div>
					<?php } ?>
		</div>
		
	</body>

</html>