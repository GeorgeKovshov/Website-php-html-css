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
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="CSS/style.css">
		<title> Great Games </title>
	</head>
	
		
	<body>
		<div class="box-1"  style="position: sticky; top:0px;">
			fuck
			<hr>
			</div>
		<div class="container_list_games">
			
		<?php  		
					$gamess = array_reverse(get_games($pdo));
					//$gamess = ["sssss", "test","Phantasmagoria 2: A Puzzle of Flesh", "Metal Gear Solid", "Earthworm Jim"];
					foreach($gamess as $gam){
						
					$result = get_game($pdo, $gam);
					$no_ws_game = str_replace(' ', '_', $gam);
				
				?>
			<div class="box_list_games">
				
				
				<div class="center_item">
					<img class="image_dimensions" src="includes/<?php echo $result["cover"]; ?>" alt="a really informative image"/><br>
				</div>
				
				<div class="center_item">
					<a href="select_game.php?nam=<?php echo $no_ws_game; ?>"> <h1><?php echo $result["game_title"]; ?> </h1></a> 
					<div >
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
				
				
				
							
				
			</div>
					<?php } ?>
		</div>
		
	</body>

</html>