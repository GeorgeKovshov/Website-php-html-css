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
	$array = ["First","Second","Third","Fourth","Fifth","Sixth","Seventth","Eigths","Ninth", "PC"];
	
	echo '<select name="generation" id="generation">';
	$i=1;
	foreach($array as $arr) { 
		echo '<option value=' . $i++ . '>' . $arr . "</option>"; 
		///$i++;
	} 
	echo '</select>';
	
	
}

function score_select(){
	
	echo '<select name="score" id="score">';
	$i=0;
	while($i < 11) { 
		echo '<option value=' . $i . '>' . $i++ . "</option>"; 
		///$i++;
	} 
	echo '</select>';
	
	
}

function company_select(object $pdo, int $type){
	//type: 1 developer (strict), 2 publisher, 3 developer (non-strict)
	$array = get_companies($pdo, $type);
	if($type == 1) {
		echo '<select name="developer" id="developer">';
	}
	else {
		echo '<select name="company" id="company">';
	}
	echo '<option value=0> Empty </option>'; 
	foreach($array as $key => $value) { 
		echo '<option value=' . $key . '>' . $value . "</option>"; 
	} 
	echo '</select>';
	
	
}

function genre_select(object $pdo, int $amount){
	$array = get_genres($pdo);
	while($amount > 0){
		echo '<select name="subgenre'. $amount .'" id="subgenre">';
		echo '<option value=0> None </option>'; 
		foreach($array as $key => $value) { 
			echo '<option value=' . $key . '>' . $value . "</option>"; 
		} 
		echo '</select>';
		$amount--;
	}
	
	
}

function platform_select(object $pdo, int $amount){
	$array = get_platforms($pdo);
	while($amount > 0){
		echo '<select name="platform'. $amount .'" id="platform">';
		echo '<option value=0> None </option>'; 
		foreach($array as $key => $value) { 
			echo '<option value=' . $key . '>' . $value . "</option>"; 
		} 
		echo '</select>';
		$amount--;
	}
	
	
}


function designer_select(object $pdo, int $amount){
	$array = get_designers($pdo);

	while($amount > 0){
		echo '<select name="designer' . $amount . '" id="designer">';
		echo '<option value=0> Empty </option>'; 
		foreach($array as $key => $value) { 
			echo '<option value=' . $key . '>' . $value . "</option>"; 
		} 
		echo '</select> <br>';
		$amount--;
	}
	
	
}
function profession_select(object $pdo, int $amount){
	$array2 = get_professions($pdo);
	
	while($amount > 0){
		echo '<select name="profession' . $amount . '" id="profession">';
		echo '<option value=0> Empty </option>'; 
		foreach($array2 as $key => $value) { 
			echo '<option value=' . $key . '>' . $value . "</option>"; 
		} 
		echo '</select><br>';
		$amount--;
	}
	
	
}

function tags_select(object $pdo, int $amount){
	$array = get_tags($pdo);
	while($amount > 0){
		echo '<select name="tag'. $amount .'" id="tag">';
		echo '<option value=0> None </option>'; 
		foreach($array as $key => $value) { 
			echo '<option value=' . $key . '>' . $value . "</option>"; 
		} 
		echo '</select>';
		$amount--;
	}
	
	
}
	
/*
function designer_select(object $pdo){
	$array = get_designers($pdo);
	
	echo '<select name="designer" id="designer">';
	echo '<option value=0> Empty </option>'; 
	foreach($array as $key => $value) { 
		echo '<option value=' . $key . '>' . $value . "</option>"; 
	} 
	echo '</select>';
	
}*/


function print_array(array $arr){
	if (empty($arr)){
		return;
	}
	$i = 0;
	foreach($arr as $tmp){
		//print_r($tmp);
		if($i != 0){
			echo ", "; 
		}
		echo $tmp;
		$i++;
		
	}
}

function print_tags(array $arr){
	if (empty($arr)){
		return;
	}
	$i = 0;
	foreach($arr as $tmp){
		//print_r($tmp);
		if($i != 0){
			echo ", "; 
		}
		echo "<span class='tag'>". '#' . $tmp . "</span>";
		$i++;
		
	}
}

function show_screenshots(array $arr){
	$i = 0;
	foreach($arr as $tmp){
		//print_r($tmp);
		if($i != 0) {
			echo '<img class="screenshots" src="includes/'. $tmp["screenshot_path"] . '" alt="a really informative image"/>';
		}
		$i++;
		
	}
}

function show_description(string $game_desc){
	$handle = fopen('includes/' . $game_desc, "r");
	if ($handle) {
		while (($line = fgets($handle)) !== false) {
			echo $line;
			echo "<br> <br>";
			// process the line read.
		}

		fclose($handle);
	}
	
}


function show_designers($des_pro){
	$i = 0;
	foreach($des_pro as $des => $pro){
		if($i != 0){
			echo ", "; 
		}
		if(is_null($pro[0])){
			echo $des;
		}
		else {
			echo $des . " (";
			print_array($pro);
			echo ")";
		}
		$i++;
		
		
	}
	
}


function screenshot_helper(string $scr){
	echo "<div>";
		echo '<img height="400" style="white-space: nowrap; padding-bottom: 1em;" src="includes/'. $scr . '" alt="a really informative image"/>';
	echo "</div>";
	
}

function description_helper(string $line){
	echo "<div style='width: 70%;'>";
			echo "<span class='vertical-center'>" . $line . "</span>";
	echo "</div>";
}

function show_screenshots_description(array $arr, string $game_desc){
	$handle = fopen('includes/' . $game_desc, "r");
	$length = count($arr);
	$i = 0;
	while($i < $length && $handle && (($line = fgets($handle)) !== false)){
		if($i % 2 == 0){
			screenshot_helper($arr[$i]["screenshot_path"] );
			description_helper($line);
		}
		else {
			description_helper($line);
			screenshot_helper($arr[$i]["screenshot_path"] );
		}
		$i++;
		
	}
	if ($handle) {
		echo "<div style='width: 50%;'>";
		while (($line = fgets($handle)) !== false) {
			echo $line;
			echo "<br> <br>";
			// process the line read.
		}
		echo "</div>";
		fclose($handle);
	}
	
	if($i<$length){
		echo "<div>";
		while($i < $length){
			echo '<img height="400" style="white-space: nowrap; padding-bottom: 1em;" src="includes/'. $arr[$i]["screenshot_path"] . '" alt="a really informative image"/>';
			$i++;
		}
		echo "</div>";
	}
	
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
		echo '<input type="date" name="closed" value=' . $_SESSION["input_data"]["closed"] . '><br>';
	}
	else {
		echo '<input type="date" name="closed"><br>';
	}
	
	echo '<label for="closed" style="font-size:16px;" >*leave empty if not closed</label><br>';

}





