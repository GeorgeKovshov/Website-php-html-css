<!DOCTYPE html>
<html lang="en">

<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>



<head>

		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<!--  <meta name="viewport" content="width=device-width, initial-->
		<title>Water deals</title>
		
</head>

<body>
		<h3> 
		<?php
			if(isset($_SESSION["user_id"])){
				echo "You are logged in as " . $_SESSION["user_username"];
			} else {
				echo "You are not logged in";
			}
		?>
		</h3>
		<h3> Login</h3>
		<form action="includes/login.inc.php" method = "post">
			<input type="text" name="username" placeholder="Username"><br>
			<input type="password" name="pwd" placeholder="Password"><br>
			<button> Login </button>
		</form>
		
		<?php check_login_errors(); ?>
		
		<h3> Signup </h3>
		<form action="includes/signup.inc.php" method = "post">
			
			<!--
				<input type="text" name="username" placeholder="Username"><br>
				<input type="password" name="pwd" placeholder="Password"><br>
				<input type="text" name="email" placeholder="E-mail"><br>
			-->
			<?php signup_inputs(); ?>
			<button> Signup </button>
		</form>
		
		<?php
			check_signup_errors();
		?>
		
		
		<h3> Logout</h3>
		<form action="includes/logout.inc.php" method = "post">
			<button> Logout </button>
		</form>
		
		<?php check_login_errors(); ?>
			
			

</body>

</html>