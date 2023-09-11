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


function input_designer(object $pdo, string $full_name, int $nationality, string $birthday, string $gender){
	set_designer($pdo, $full_name, $nationality, $birthday, $gender);
		
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

function get_tags(object $pdo){
	return get_tags_from_db($pdo);
}


function get_game(object $pdo, string $name){
	$result = get_game_from_db($pdo, $name);
	//$tmpo = get_by_id_from_db($pdo, "developer", "title", "developer_id", $result["developer"]);
	///foreach($tmpo as $key=>$value){
	//	$result["developer"] = $value;
	///}
	$result["developer"] = get_by_id_from_db($pdo, "developer", "title", "developer_id", $result["developer"])["0"]["title"];
	
	$genres_id = get_by_id_from_db($pdo, "games_genre", "genre_id", "game_id", $result["game_id"]);
	$tmpo2 = array();
	foreach($genres_id as $tmp){
		array_push($tmpo2, get_by_id_from_db($pdo, "genre", "genre_name", "genre_id", $tmp["genre_id"])["0"]["genre_name"]);
	}
	$result["genres"] = $tmpo2;
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

function input_genre(object $pdo, string $genre_name, string $genre_description, int $subgenre){
	set_genre($pdo, $genre_name, $genre_description, $subgenre);
}

function input_game(object $pdo, string $game_title, string $series_title, string $released, int $developer, int $publisher, array $genre, array $designer, array $platform, int $score, string $game_description, array $tags, array $files){
	if($files[0] != "covers/") {
		$cover = $files[0];
	}
	else{
		$cover = "NULL";
	}
	set_game($pdo, $game_title, $series_title, $released, $developer, $publisher, $score, $game_description, $cover); 
	$game_id = get_id($pdo, $game_title, "game_title", "games", "game_id");
	foreach($designer as $d){	if($d != '0') {set_relation($pdo, "dev_people", "person_id", "developer_id", intval($d), $developer);}}
	foreach($designer as $d){	if($d != '0') {set_relation($pdo, "games_people", "person_id", "game_id", intval($d), $game_id);}}
	foreach($platform as $p){	if($p != '0') {set_relation($pdo, "games_platform", "platform_id", "game_id", intval($p), $game_id);}}
	foreach($genre as $g){		if($g != '0') {set_relation($pdo, "games_genre", "genre_id", "game_id", intval($g), $game_id);}}
	foreach($tags as $t){		if($t != '0') {set_relation($pdo, "games_tags", "tag_id", "game_id", intval($t), $game_id);}}
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