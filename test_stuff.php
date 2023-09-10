<?php
require_once "./includes/dbh_games.inc.php";
require_once "includes/ggb_model.inc.php"; 
require_once "includes/ggb_view.inc.php"; 


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

function get_designers1(object $pdo){
	return get_designers_from_db($pdo);
}


function designer_select1(object $pdo, int $amount){
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


function change_session_variable(string $i){
	if(isset($_POST['+'])){
		$_SESSION[$i] = $_SESSION[$i] + 1;
	}
	else if(isset($_POST['-'])){
		$_SESSION[$i] = $_SESSION[$i] - 1;
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

//try{
//	echo 1;
	//print_r(check_relation_exists2($pdo, "dev_people", "person_id", "developer_id", 1, 1));
	//designer_select($pdo, 3);
	//get_id($pdo, "M", "game_title", "games", "game_id");
//}
 ////catch(PDOException $e) {
///		die("Query failed: " . $e->getMessage());
//}
//$pdo = null;
//header("Location: test_stuff.php");
////die();
 ?>
 <script>
	if ( window.history.replaceState ) {
	window.history.replaceState( null, null, window.location.href );
	}
</script>
		<form action="test_stuff.php" method = "post">
				Change "genre" amount:
			<?php 
				if(!isset($_SESSION["image_amount"])){
					$_SESSION["image_amount"] = 1;
				}
				if($_SERVER["REQUEST_METHOD"] == "POST"){
					change_session_variable("image_amount");
				}
				
				
				
			?>	
			<button name="+" style="padding:2px 5px;"> + </button>
			<button name="-" style="padding:2px 7px;"> - </button>
		
			<br>
			</form>
 <form action="includes/upload_cover.inc.php" enctype="multipart/form-data" method="post">
 <div class="box-input" style="width:300px;">
				<?php
					$i = $_SESSION["image_amount"];
					while($i>0){
						echo '<span> Upload Cover:</span> <input type="file" name="cover_image' . $i .  '" id="cover_image">';
						$i--;
					}
				
				?>
				
					<!-- <span> Upload Cover:</span> <input type="file" name="cover_image" id="cover_image"> -->
					<br>
					<span> Upload Screenshots:</span> 
					<button> submit </button>
				</div>
				
			</form>
			
		<div class="container-input">
			<?php check_input_errors(); ?>
		</div>
		


