<?php

declare(strict_types=1);


function change_session_variable(string $i){
	if(isset($_POST['+'])){
		$_SESSION[$i] = $_SESSION[$i] + 1;
	}
	else if(isset($_POST['-'])){
		$_SESSION[$i] = $_SESSION[$i] - 1;
	}
}


function input_designer(object $pdo, string $full_name, int $nationality, string $birthday, string $gender, string $deceased){
	set_designer($pdo, $full_name, $nationality, $birthday, $gender, $deceased);
		
}

function get_countries(object $pdo){
	return get_countries_from_db($pdo);
}

function get_companies(object $pdo, int $type){
	return get_companies_from_db($pdo, $type);
}

function get_genres(object $pdo){
	return get_genres_from_db($pdo);
}

function get_platforms(object $pdo){
	return get_platforms_from_db($pdo);
}

function get_designers(object $pdo){
	return get_designers_from_db($pdo);
}
function get_professions(object $pdo){
	return get_professions_from_db($pdo);
}

function get_tags(object $pdo){
	return get_tags_from_db($pdo);
}

function get_games(object $pdo){
	return get_games_from_db($pdo);
}



function get_game_helper(object $pdo, array $id_numbers, string $table_name, string $column_name, string $column_id){
	$tmpo2 = array();
	foreach($id_numbers as $tmp){
		if($column_id == "people_id"){
			array_push($tmpo2, get_by_id_from_db($pdo, $table_name, $column_name, $column_id, $tmp["person_id"])["0"][$column_name]);
		}
		else{
			array_push($tmpo2, get_by_id_from_db($pdo, $table_name, $column_name, $column_id, $tmp[$column_id])["0"][$column_name]);
		}
	}
	return $tmpo2;
	
}

function sort_designer_professions(array $des_pro){
	$result = array();
	foreach($des_pro as $key => $value){
		if (!isset($result[$value["full_name"]])){
			$result[$value["full_name"]] = array();
		}
		array_push($result[$value["full_name"]], $value["title"]);
	}
	
	return $result;
}


function get_game(object $pdo, string $name){
	$result = get_game_from_db($pdo, $name);
	//$tmpo = get_by_id_from_db($pdo, "developer", "title", "developer_id", $result["developer"]);
	///foreach($tmpo as $key=>$value){
	//	$result["developer"] = $value;
	///}
	$result["developer"] = get_by_id_from_db($pdo, "developer", "title", "developer_id", $result["developer"])["0"]["title"];
	$result["publisher"] = get_by_id_from_db($pdo, "publisher", "title", "publisher_id", $result["publisher"])["0"]["title"];
	
	//get genres
	$genres_id = get_by_id_from_db($pdo, "games_genre", "genre_id", "game_id", $result["game_id"]);
	$result["genres"] = array_reverse(get_game_helper($pdo, $genres_id, "genre", "genre_name", "genre_id"));
	//get platform
	$platforms_id = get_by_id_from_db($pdo, "games_platform", "platform_id", "game_id", $result["game_id"]);
	$result["platforms"] = array_reverse(get_game_helper($pdo, $platforms_id, "platform", "platform_name", "platform_id"));
	//get designers
	///$designers_id = get_by_id_from_db($pdo, "games_people", "person_id", "game_id", $result["game_id"]);
	///$result["designers"] = array_reverse(get_game_helper($pdo, $designers_id, "people", "full_name", "people_id"));
	//get tags
	$tags_id = get_by_id_from_db($pdo, "games_tags", "tag_id", "game_id", $result["game_id"]);
	$result["tags"] = array_reverse(get_game_helper($pdo, $tags_id, "tags", "tag_title", "tag_id"));
	
	$tmp = get_developer_profession_from_db($pdo, intval($result["game_id"]));
	$result["des_pro"] = sort_designer_professions($tmp);
	
	//get screenshots
	$result["screenshots"] = array_reverse(get_by_id_from_db($pdo, "screenshots", "screenshot_path", "game_id", $result["game_id"]));
	//$designers_id = get_by_id_from_db($pdo, "games_people", "person_id", "game_id", $result["game_id"]);
	//$result["screenshots"] = get_game_helper($pdo, $screenshots, "people", "full_name", "people_id");
	
	return $result;
	}




function is_input_empty(array $inputs){
	foreach($inputs as $input){
		if(empty($input)){
			return true;
		}
		
	}
	return false;
		
}

function is_zero_input(array $inputs){
	foreach($inputs as $input){
		if($input != 0){
			return false;
		}
		
	}
	return true;
		
}


function is_name_taken(object $pdo, string $current_name, string $name, string $table){
	if(get_name($pdo, $current_name, $name, $table)){
		return true;
	}	
	else{
		return false;
	}
		
}


function input_company(object $pdo, string $company_name, int $country, string $company_type, string $founded, string $closed){
	set_company($pdo, $company_name, $country, $company_type, $founded, $closed);

		
}

function input_platform(object $pdo, string $platform_name, int $company, int $generation, string $released, string $discontinued){
	set_platform($pdo, $platform_name, $company, $generation, $released, $discontinued);
	
}

function input_genre(object $pdo, string $genre_name, string $genre_description, array $subgenre){
	
	set_genre($pdo, $genre_name, $genre_description);
	$genre_id = get_id($pdo, $genre_name, "genre_name", "genre", "genre_id");
	foreach($subgenre as $g){	if($g != '0') {set_relation($pdo, "subgenre_relation", "genre_id", "subgenre_id", intval($g), $genre_id);}}
}

function input_profession(object $pdo, string $title, string $profession_description){
	set_profession($pdo, $title, $profession_description);
}

function input_tag(object $pdo, string $tag_title){
	set_tag($pdo, $tag_title);
}



function input_game(object $pdo, string $game_title, string $series_title, string $released, string $developer_title, string $publisher_title, array $genre_names, array $designer_names, array $profession, array $platform_names, int $score, string $game_description, array $tags_names, array $files){
	//function to input a game into database
	
	if($files[0] != "covers/") {
		$cover = $files[0];
	}
	else{
		$cover = "NULL";
	}
	
	/*
	//converting the names to IDs
	$developer = get_id($pdo, $developer_title, "title", "developer", "developer_id"); 
	$publisher = get_id($pdo, $publisher_title, "title", "publisher", "publisher_id");
	$genre = [];
	foreach($genre_names as $g) { array_push($genre, get_id($pdo, $g, "genre_name", "genre", "genre_id"));}
	$designer = [];
	foreach($designer_names as $d) { array_push($designer, get_id($pdo, $d, "full_name", "people", "people_id"));}
	$platform = [];
	foreach($platform_names as $p) { array_push($platform, get_id($pdo, $p, "platform_name", "platform", "platform_id"));}
	$tags= [];
	foreach($tags_names as $t) { array_push($tags, get_id($pdo, $t, "tag_title", "tags", "tag_id"));}
	*/
	
	
	set_game($pdo, $game_title, $series_title, $released, $developer, $publisher, $score, $game_description, $cover); 
	$game_id = get_id($pdo, $game_title, "game_title", "games", "game_id");
	foreach($designer as $d){	if($d != '0') {set_relation($pdo, "dev_people", "person_id", "developer_id", intval($d), $developer);}}
	foreach($platform as $p){	if($p != '0') {set_relation($pdo, "games_platform", "platform_id", "game_id", intval($p), $game_id);}}
	foreach($genre as $g){		if($g != '0') {set_relation($pdo, "games_genre", "genre_id", "game_id", intval($g), $game_id);}}
	foreach($tags as $t){		if($t != '0') {set_relation($pdo, "games_tags", "tag_id", "game_id", intval($t), $game_id);}}
	$j = 0;
	foreach($designer as $d){
		if($d != '0') {
			set_relation_more($pdo, "games_people", "person_id", "game_id", "profession_id", intval($d), $game_id, intval($profession[$j]));
		}
		$j++;
	}
	$length = count($files);
	$i = 1;
	while($i < $length){
		if($files[$i] != "screenshots/") {
			set_screenshot($pdo, $files[$i], $game_id);
		}
		$i++;
	}
				//if($files[0] != "covers/") {	set_relation()}
}


function input_game_old(object $pdo, string $game_title, string $series_title, string $released, int $developer, int $publisher, array $genre, array $designer, array $profession, array $platform, int $score, string $game_description, array $tags, array $files){
	if($files[0] != "covers/") {
		$cover = $files[0];
	}
	else{
		$cover = "NULL";
	}
	
	set_game($pdo, $game_title, $series_title, $released, $developer, $publisher, $score, $game_description, $cover); 
	$game_id = get_id($pdo, $game_title, "game_title", "games", "game_id");
	foreach($designer as $d){	if($d != '0') {set_relation($pdo, "dev_people", "person_id", "developer_id", intval($d), $developer);}}
	foreach($platform as $p){	if($p != '0') {set_relation($pdo, "games_platform", "platform_id", "game_id", intval($p), $game_id);}}
	foreach($genre as $g){		if($g != '0') {set_relation($pdo, "games_genre", "genre_id", "game_id", intval($g), $game_id);}}
	foreach($tags as $t){		if($t != '0') {set_relation($pdo, "games_tags", "tag_id", "game_id", intval($t), $game_id);}}
	$j = 0;
	foreach($designer as $d){
		if($d != '0') {
			set_relation_more($pdo, "games_people", "person_id", "game_id", "profession_id", intval($d), $game_id, intval($profession[$j]));
		}
		$j++;
	}
	$length = count($files);
	$i = 1;
	while($i < $length){
		if($files[$i] != "screenshots/") {
			set_screenshot($pdo, $files[$i], $game_id);
		}
		$i++;
	}
				//if($files[0] != "covers/") {	set_relation()}
}

function initiate_fill_datalist(string $name){
	// this function creates a variable in JS for a datalist element and ties an AJAX function to it that fills it
	// string $name is the name of the html element that corresponds (it has to be exact) to the PHP POST parameter name in ajax_fill_datalist.inc.js
	echo '
				<script>
				let ' . $name . ' = document.getElementById("' . $name . '_selector_input");
				if(' . $name . '_selected != "none"){
					' . $name . '.setAttribute("value", ' . $name . '_selected);
				}
				' . $name . '.addEventListener("keyup", fill_datalist);
				</script>
			
			';
	
}





