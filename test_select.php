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
			<div class="box-1">
				<?php  
					$result = get_game($pdo, "Metal Gear Solid");
				
				?>
				
				
				<img height="500" src="includes/<?php echo $result["cover"]; ?>" alt="a really informative image"/>
				<div>
					<h1><?php echo $result["game_title"]; ?></h1>
					<p><?php echo "Released: " . $result["release_date"]; ?></p>
					<p><?php echo "Developer: " . $result["developer"];?></p>
					<p>Genres:
					<?php 
						foreach($result["genres"] as $tmp){
							//print_r($tmp);
							echo $tmp . "; "; 
						}
						
					?></p>
					
					
					<p><?php echo htmlspecialchars($result["game_description"]); ?></p>
				</div>
							
				
			</div>
			
		</div>
		
	</body>

</html>