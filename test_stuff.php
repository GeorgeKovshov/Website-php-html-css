<?php
require_once "./includes/dbh_games.inc.php";
require_once "includes/ggb_model.inc.php"; 

function get_id2(object $pdo, string $current_name, string $name, string $table, string $id_column) {
	echo 2;
	$query = "SELECT $id_column FROM $table WHERE $name = :current_name;";
	$stmt = $pdo->prepare($query);
	//$stmt->bindParam(':name', $name);
	//$stmt->bindParam(':table', $table);
	$stmt->bindParam(":current_name", $current_name);
	$stmt->execute();
	
	
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt = null;
	print_r($result);
}	

function get_designers(object $pdo){
	return get_designers_from_db($pdo);
}


function designer_select(object $pdo, int $amount){
	$array = get_designers($pdo);
	while($amount > 0){
		echo '<select name="designer' . $amount . '" id="designer">';
		echo '<option value=0> Empty </option>'; 
		foreach($array as $key => $value) { 
			echo '<option value=' . $key . '>' . $value . "</option>"; 
		} 
		echo '</select>';
		$amount--;
	}
	
	
}

function check_relation_exists2(object $pdo, string $table_name, string $column_one_name, string $column_two_name, int $column_one_value, int $column_two_value) {
	$query = "SELECT $column_one_name FROM $table_name WHERE $column_one_name = :column_one_value AND $column_two_name = :column_two_value;";

	$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":column_one_value", $column_one_value);
	$stmt->bindParam(":column_two_value", $column_two_value);
	
	$stmt->execute();
	
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt = null;
	return $result;
}	

function function1(string $i){
	if(isset($_POST['+'])){
		$_SESSION[$i] = $_SESSION[$i] + 1;
	}
	else if(isset($_POST['-'])){
		$_SESSION[$i] = $_SESSION[$i] - 1;
	}
}

///echo 1;<form action="includes/variable_increase.inc.php" method = "post"> <?php
require_once 'includes/config_session.inc.php';

try{
	?>
	  <form action="test_stuff.php" method = "post"> <?php
		if(!isset($_SESSION["j"])){
			$_SESSION["j"] = 2;
		}
		
		function1("j");
		
		
		echo $_SESSION["j"];
		
		?>	
		<button name="+"> + </button>
		<button name="-"> - </button>
	</form>	
		
	<?php
	//print_r(check_relation_exists2($pdo, "dev_people", "person_id", "developer_id", 1, 1));
	//designer_select($pdo, 3);
	//get_id($pdo, "M", "game_title", "games", "game_id");
}
 catch(PDOException $e) {
		die("Query failed: " . $e->getMessage());
}
$pdo = null;
//header("Location: test_stuff.php");
die();
 ?>


