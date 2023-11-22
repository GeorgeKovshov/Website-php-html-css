<?php

declare(strict_types=1);

function nations_select(object $pdo){
	$array = get_countries($pdo);

	echo '<select name="country" id="country">';
	foreach($array as $key => $value) { 
		echo '<option value=' . $key . '>' . $value . "</option>"; 
	} 	  
	echo '</select>';
	
	
}

function nations_select_2(object $pdo, int $selected){
	$array = get_countries($pdo);
	
	echo '<select name="country" id="country">';
	$i = 1;
	foreach($array as $key => $value) { 
		if($i != $selected){
			echo '<option value=' . $key . '>' . $value . "</option>"; 
		} else {
			echo '<option value=' . $key . ' selected="selected">' . $value . "</option>"; 
		}
		
		$i++;
	} 

	echo '</select>';
	
	
}


function generation_select(int $selected){
	$array = ["First","Second","Third","Fourth","Fifth","Sixth","Seventth","Eigths","Ninth", "PC"];
	
	echo '<select name="generation" id="generation">';
	$i=1;
	foreach($array as $arr) { 
		if($i != $selected) {
			echo '<option value=' . $i . '>' . $arr . "</option>"; 
		} else {
			echo '<option value=' . $i . ' selected="selected">' . $arr . "</option>"; 
		}
		$i++;
	} 
	echo '</select>';
	
	
}



function score_select(int $selected){
	
	echo '<select name="score" id="score">';
	$i=0;
	while($i < 11) { 
		if($i != $selected) {
			echo '<option value=' . $i . '>' . $i . "</option>"; 
		} else {
			echo '<option value=' . $i . ' selected="selected">' . $i . "</option>"; 
		}
		$i++;
	} 
	echo '</select>';
	
	
}



function create_datalist(object $pdo, array $arr){
	//function to create a datalist with a given list of categories. The arr determines what tables the data will be pulled from.
	// there need to be a premade divs with id="'your_name'_big_selector_div" for this function to fill them
	// each name has to be typed like this: 'your_name'_single or 'your_name'_many. many will allow user to use + and - buttons to manage amount of selectors for category, single will restrict the field to just one selector.
	//FOURTH ITERATION
	
	

	// this will create the datalist			
	echo '<script>'; echo 'let list_of_categories =';			
		echo json_encode($arr); 
	echo '</script>';
	
	echo '<script src="includes/java_manage_datalists.inc.js">';	
	echo '</script>';

	
	
}



function print_array(array $arr){
	if (empty($arr)){
		return;
	}
	$i = 0;
	foreach($arr as $tmp){
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
		if($i != 0){
			echo ", "; 
		}
		echo "<span class='tag'>". '#' . $tmp . "</span>";
		$i++;
		
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


function show_screenshots(array $arr, int $start){
	echo "<div class='screenshots_div'>";
	$i = 0;
	foreach($arr as $tmp){
		if($i >= $start) {
			echo '<img class="screenshots" src="includes/'. $tmp["screenshot_path"] . '" alt="a really informative image"/>';
		}
		$i++;
		
	}
	echo "</div>";
}



function show_screenshots_description(string $game_desc, array $screenshots, string $score){
	$handle = fopen('includes/' . $game_desc, "r");
	$text = "";
	if ($handle) {
		while (($line = fgets($handle)) !== false) {
			$text = $text . $line . "<br> <br>";
			// process the line read.
		}
		fclose($handle);
	}
	$text = $text . "My score: " . $score . "/10 <br><br>";
	$start = 1;
	echo '<div class="cover_div" style="align-self:start; justify-content:center; padding-top:10px;">';
		echo '<img class="screenshots" src="includes/'; 
		echo $screenshots[0]["screenshot_path"]; 
		echo'" alt="a really informative image"/><br>';
	if(strlen($text) > 1750){
		$start++;
		echo '<img class="screenshots" src="includes/'; 
		echo $screenshots[1]["screenshot_path"]; 
		echo'" alt="a really informative image"/><br>';
	}
	echo '</div>';
	
	echo '<div>' . $text . '</div>';
	show_screenshots($screenshots, $start);
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
	echo '
		<div class="box-input">
			<h3> Input a company</h3>
			<form action="includes/input_company.inc.php" method = "post">
			
	';
			
	
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
	
	echo ' 
			<button> Submit </button> 
			</form>
		</div>';

}

function genre_inputs(object $pdo){
	echo '
		<div class="box-input">
			<h3> Input a genre</h3>
			<form action="includes/input_genre.inc.php" method = "post">
	';
	
	if(isset($_SESSION["input_data"]["genre_name"])){
		echo '<input type="text" name="genre_name" placeholder="Name of the Genre" value=' . $_SESSION["input_data"]["genre_name"] . '><br>';
	}
	else {
		echo '<input type="text" name="genre_name" placeholder="Name of the Genre"><br>';
	} 
	
	echo '<div id="java_genre">';
		echo '	<span style="font-size:16px;"> Subgenre of: </span><br>'; echo '<div id="subgenre_big_selector_div"></div>';
	echo '</div>';
	
	
	if(isset($_SESSION["input_data"]["genre_description"])){
		echo '<textarea name="genre_description" placeholder="genre_description" rows="4" cols="50">' . $_SESSION["input_data"]["genre_description"] . '</textarea><br>';
	}
	else {
		echo '<textarea name="genre_description" placeholder="genre_description" rows="4" cols="50">Write a description of the genre... </textarea><br>';
	} 
	
	echo '
				<button> Submit </button>
			</form>
		</div>';
		
	$session_variables = [];// this is for filling in value the user has inputted when the submit shows an error
	array_push($session_variables, $_SESSION["input_data"]["subgenres"]);
	echo '<script>'; echo 'let session_vars ='; echo json_encode($session_variables); echo '</script>';
	create_datalist($pdo, ["subgenre_many"]);
}


function platform_inputs(object $pdo){
	echo ' 
			<div class="box-input">
				<h3> Input a platform</h3>
				<form action="includes/input_platform.inc.php" method = "post"> ';
				
	
	
	if(isset($_SESSION["input_data"]["platform_name"])){
		echo '
				<input type="text" name="platform_name" placeholder="Platform title" value=' . $_SESSION["input_data"]["platform_name"] .  '><br>';
	} else {
		echo '
				<input type="text" name="platform_name" placeholder="Platform title"><br>';
	}
	
	if(isset($_SESSION["input_data"]["generation"])){
		echo '
				<span style="font-size:16px;"> Generation: </span>'; generation_select((int)$_SESSION["input_data"]["generation"]); echo '<br>';
	} else {
		echo '
				<span style="font-size:16px;"> Generation: </span>'; generation_select(-1); echo '<br>';
	}
	

	echo '	
				<span style="font-size:16px;"> Company:</span> <br>
				<div id="company_big_selector_div"></div>';
				
	$session_variables = [];// this is for filling in value the user has inputted when the submit shows an error
	array_push($session_variables, $_SESSION["input_data"]["company"]);
	echo '<script>'; echo 'let session_vars ='; echo json_encode($session_variables); echo '</script>';
	
	create_datalist($pdo, ["company_single"]);
	

	
	
	
	if(isset($_SESSION["input_data"]["released"])){
		echo '
				<span style="font-size:16px;"> Released: </span> <input type="date" name="released" value=' . $_SESSION["input_data"]["released"] . '><br>';
	} else {
		echo '
				<span style="font-size:16px;"> Released: </span> <input type="date" name="released"><br>';
	}
	
	if(isset($_SESSION["input_data"]["discontinued"])){
		echo '
				<span style="font-size:16px;"> Discontinued*: </span> <input type="date" name="discontinued" value=' . $_SESSION["input_data"]["discontinued"] . '><br>';
	} else {
		echo '
				<span style="font-size:16px;"> Discontinued*: </span> <input type="date" name="discontinued"><br>';
	}
	

	
	echo '
				<label for="discontinued" style="font-size:16px;" >*leave empty if not discontinued</label><br>
					
					<button> Submit </button>
				</form>
			</div>';
	
}


function designer_inputs(object $pdo){
	
	echo '
			<div class="box-input">
				<h3> Input a person</h3>
				<form action="includes/input_designer.inc.php" method = "post">';
	
	if(isset($_SESSION["input_data"]["full_name"])){
		echo '
					<input type="text" name="full_name" placeholder="Full name" value=' . $_SESSION["input_data"]["full_name"] . '><br>';
	} else {
		echo '
					<input type="text" name="full_name" placeholder="Full name"><br>';
	}
	
	if(isset($_SESSION["input_data"]["nationality"])){
		echo '
					<span style="font-size:16px;"> Country: </span>'; nations_select_2($pdo, (int)$_SESSION["input_data"]["nationality"]);
	} else {
		echo '
					<span style="font-size:16px;"> Country: </span>'; nations_select_2($pdo, -1);
	}					
	
	if(isset($_SESSION["input_data"]["birthday"])){
		echo '
					<input type="date" name="birthday" placeholder="Birthday" value=' . $_SESSION["input_data"]["birthday"] . '><br>';
	} else {
		echo '
					<input type="date" name="birthday" placeholder="Birthday"><br>';
	}
					
	if(isset($_SESSION["input_data"]["deceased"])){
		echo '
					<input type="date" name="deceased" placeholder="deceased" value=' . $_SESSION["input_data"]["deceased"] . '><br>';
	} else {
		echo '
					<input type="date" name="deceased" placeholder="deceased"><br>';
	}
					
	
	if(!isset($_SESSION["input_data"]["gender"]) || $_SESSION["input_data"]["gender"] == "Male"){
		echo '		<input type="radio" name="gender" id="gender" value="Male" checked="checked"/>';				
	} else {
		echo '		<input type="radio" name="gender" id="gender" value="Male" />';
	}
	echo '			<label for="gender" style="font-size:16px;" >Male</label><br>';	
	
	if(isset($_SESSION["input_data"]["gender"]) && $_SESSION["input_data"]["gender"] == "Female"){
		echo '		<input type="radio" name="gender" id="gender" value="Female" checked="checked"/>';				
	} else {
		echo '		<input type="radio" name="gender" id="gender" value="Female" />';
	}
	echo '			<label for="gender" style="font-size:16px;" >Female</label><br>';	

	if(isset($_SESSION["input_data"]["gender"]) && $_SESSION["input_data"]["gender"] == "Other"){
		echo '		<input type="radio" name="gender" id="gender" value="Other" checked="checked"/>';				
	} else {
		echo '		<input type="radio" name="gender" id="gender" value="Other" />';
	}
	echo '			<label for="gender" style="font-size:16px;" >Other</label><br>';			 
		 
	echo '							
					<button> Submit </button>
				</form>
			</div>';	
}

function profession_inputs(object $pdo){
	echo '	
			<div class="box-input">
				<h3> Input a profession</h3>
				<form action="includes/input_profession.inc.php" method = "post">';
	if(isset($_SESSION["input_data"]["title"])){
		echo '			
					<input type="text" name="title" placeholder="Profession title" value=' . $_SESSION["input_data"]["title"] . '><br>';
	} else {
		echo '			
					<input type="text" name="title" placeholder="Profession title"><br>';
	}
	
	if(isset($_SESSION["input_data"]["profession_description"])){
		echo '			
					<textarea name="profession_description" placeholder="profession_description" rows="4" cols="50">' . $_SESSION["input_data"]["profession_description"] . '</textarea><br>';
	} else {
		echo '			
					<textarea name="profession_description" placeholder="profession_description" rows="4" cols="50">Write a description of the genre... </textarea><br>';
	}
	
	echo '				
					<button> Submit </button>
				</form>
			</div>';
	
	
}


function tag_inputs(object $pdo){
	echo '	
			<div class="box-input">
				<h3> Input a tag</h3>
				<form action="includes/input_tag.inc.php" method = "post">
					<input type="text" name="tag_title" placeholder="Enter a #tag"><br>
					<button> Submit </button>
				</form>
			</div>';
	
}

function game_inputs(object $pdo){
	if(isset($_SESSION["input_data"]["game_title"])){
		echo '
				<input type="text" name="game_title" value=' . $_SESSION["input_data"]["game_title"] .  '><br>';
	} else {
		echo '
				<input type="text" name="game_title" placeholder="Game Title"><br>';
	}
				
	if(isset($_SESSION["input_data"]["series_title"])){
		echo '
				<input type="text" name="series_title" value=' . $_SESSION["input_data"]["series_title"] .  '><br>';
	} else {
		echo '
				<input type="text" name="series_title" placeholder="Series Title"><br>';
	}
	
	if(isset($_SESSION["input_data"]["released_game"])){
		echo '
				<span style="font-size:16px;"> Date of Release: </span><br> <input type="date" name="released" value=' . $_SESSION["input_data"]["released_game"] . '><br>';
	} else {
		echo '
				<span style="font-size:16px;"> Date of Release: </span><br> <input type="date" name="released"><br>';
	}
	
}










