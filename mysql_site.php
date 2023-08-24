<!DOCTYPE html>
<html lang="en">

<head>

		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<!--  <meta name="viewport" content="width=device-width, initial-->
		<title>Water deals</title>
		
</head>

<body>
		<h3> Water deals</h3>
		<form action="includes/formhandler.inc.php" method = "post">
			<input type="number" name="start" placeholder="Start">
			<input type="number" name="end" placeholder="End">
			<input type="number" name="price" placeholder="Price">
			<button> Submit </button>
		</form>
		<form action="search.php" method = "post">
			<input type="number" name="start_search" placeholder="Start search">
			<button> Search </button>
		</form>
			
			

</body>

</html>