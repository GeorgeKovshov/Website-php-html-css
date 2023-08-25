<!DOCTYPE html>
<html lang="en">

<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';

?>



<head>

		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<!--  <meta name="viewport" content="width=device-width, initial-->
		<title>Water deals</title>
		
</head>

<body>
		<h3> Login</h3>
		<form action="includes/login.inc.php" method = "post">
			<input type="text" name="username" placeholder="Username"><br>
			<input type="password" name="pwd" placeholder="Password"><br>
			<button> Login </button>
		</form>
		<h3> Signup </h3>
		<form action="includes/signup.inc.php" method = "post">
			<input type="text" name="username" placeholder="Username"><br>
			<input type="password" name="pwd" placeholder="Password"><br>
			<input type="text" name="email" placeholder="E-mail"><br>
			<button> Signup </button>
		</form>
		
		<?php
			check_signup_errors();
		?>
			
			

</body>

</html>