<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){
	$start_search = $_POST["start_search"];

	
	try{
		require_once "include/dbh.inc.php";
		
		$query = "SELECT * FROM water_company WHERE start == :start_search;";
		
		$stmt = $pdo->prepare($query);

		$stmt->bindParam(":start_search", $start_search);
		
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

<!DOCTYPE html>
<html lang="en">

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
				echo htmlspecialchars($row["id"]);
				echo htmlspecialchars($row["start"]);
				echo htmlspecialchars($row["end"]);
				echo htmlspecialchars($row["price"]);
			}
			
		}
		
		?>
			

</body>

</html>





