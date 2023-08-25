<!DOCTYPE html>
<html lang="en">
<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){
	$usersearch = $_POST["usersearch"];

	
	try{
		
		require_once "includes/dbh.inc.php";

		$query = "SELECT * FROM water_company WHERE start > :usersearch;";
		
		$stmt = $pdo->prepare($query);

		$stmt->bindParam(":usersearch", $usersearch);
		
		$stmt->execute();
		
		
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$pdo = null;
		$stmt = null;

	} catch (PDOException $e){
		die("Query failed: " . $e->getMessage());
	}
	
	
} else {
	header("Location: mysql_site.php");
}
?>




<head>

		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<!--  <meta name="viewport" content="width=device-width, initial-->
		<title>Water results</title>
		
</head>

<body>
		<h3>Search results:</h3>
		
		<?php
		
		if(empty($results)){
			echo "<div>";
			echo "<p>There were no results!</p>";
			echo "</div>";	
		}
		else {
			foreach($results as $row){
				echo "id:" . htmlspecialchars($row["id"]) . " ";
				echo "start:" . htmlspecialchars($row["start"]) . " ";
				echo "end:" . htmlspecialchars($row["end"]) . " ";
				echo "price:" . htmlspecialchars($row["price"]) . "<br>";
			}
			
		}
		
		?>
			

</body>

</html>





