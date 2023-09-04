<?php

declare(strict_types=1);

function nations_select(object $pdo){
	$array = get_countries($pdo);
	//echo $array[3];
	/*foreach($array as $key => $value) { 
		echo $key . ": " . $value . "<br>"; 
	} */
	
	echo '<select name="country" id="country">';
	foreach($array as $key => $value) { 
		echo '<option value=' . $key . '>' . $value . "</option>"; 
	} 
		  //<option value="None">Select Nationality</option>
	echo '</select>';
	
	
}


function generation_select(){
	$array = ["First","Second","Third","Fourth","Fifth","Sixth","Seventth","Eigths","Ninth"];
	
	echo '<select name="generation" id="generation">';
	$i=1;
	foreach($array as $arr) { 
		echo '<option value=' . $i++ . '>' . $arr . "</option>"; 
		///$i++;
	} 
	echo '</select>';
	
	
}

function company_select(object $pdo){
	$array = get_companies($pdo);
	
	echo '<select name="company" id="company">';
	foreach($array as $key => $value) { 
		echo '<option value=' . $key . '>' . $value . "</option>"; 
	} 
	echo '</select>';
	
	
}

function genre_select(object $pdo){
	$array = get_genres_from_db($pdo);
	
	echo '<select name="subgenre" id="subgenre">';
	foreach($array as $key => $value) { 
		echo '<option value=' . $key . '>' . $value . "</option>"; 
	} 
	echo '</select>';
	
	
}

function check_input_errors(){
	if(isset($_SESSION["errors_input"])){
		$errors = $_SESSION["errors_input"];
		
		echo "<br>";
		foreach($errors as $error){
			echo '<p class="error">' . $error . '</p>'; 
		}
		
		unset($_SESSION["errors_input"]);
	}
	else if(isset($_GET["input"])&& $_GET["input"] == "success"){
		echo '<br>';
		echo '<p class="success"> Input successful! </p>';
		
	}
}


function company_inputs(object $pdo){
	/*
					<input type="text" name="company_name" placeholder="Name of the company"><br>
					<span style="font-size:16px;"> Country: </span> <?php nations_select($pdo); ?><br>
					
					
					
					<input type="radio" name="company_type" id="type" value="developer" />
					<label for="type" style="font-size:16px;" >Developer</label><br>

					<input type="radio" name="company_type" id="type" value="publisher" />
					<label for="type" style="font-size:16px;" >Publisher</label><br>
					<span style="font-size:16px;"> Founded: </span> <input type="date" name="founded"><br>
					<span style="font-size:16px;"> Closed: </span> <input type="date" name="closed"><br>
					<label for="closed" style="font-size:16px;" >*leave empty if not closed</label><br>

					
					*/

	if(isset($_SESSION["input_data"]["company_name"])){
		echo '<input type="text" name="company_name" placeholder="Name of the company" value=' . $_SESSION["input_data"]["company_name"] . '><br>';
	}
	else {
		echo '<input type="text" name="company_name" placeholder="Name of the company"><br>';
	} 
	echo '<span style="font-size:16px;"> Country: </span>'; nations_select($pdo);  echo '<br>';
	?>
	<input type="radio" name="company_type" id="type" value="developer" />
	<label for="type" style="font-size:16px;" >Developer</label><br>

	<input type="radio" name="company_type" id="type" value="publisher" />
	<label for="type" style="font-size:16px;" >Publisher</label><br>
	<?php
	

	echo '<span style="font-size:16px;"> Founded: </span>';
	if(isset($_SESSION["input_data"]["founded"])){
		echo '<input type="date" name="founded" value=' . $_SESSION["input_data"]["founded"] . '><br>';
	}
	else {
		echo '<input type="date" name="founded"><br>';
	}
	echo '<span style="font-size:16px;"> Closed: </span>'; 
	if(isset($_SESSION["input_data"]["closed"])){
		echo '<input type="date" name="founded" value=' . $_SESSION["input_data"]["closed"] . '><br>';
	}
	else {
		echo '<input type="date" name="closed"><br>';
	}
	
	echo '<label for="closed" style="font-size:16px;" >*leave empty if not closed</label><br>';

}