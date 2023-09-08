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

function input_game(object $pdo, string $game_title, string $series_title, string $released, int $developer, int $publisher, array $genre, array $designer, array $platform, int $score, string $game_description){
	set_game($pdo, $game_title, $series_title, $released, $developer, $publisher, $score, $game_description); 
	$game_id = get_id($pdo, $game_title, "game_title", "games", "game_id");
	foreach($designer as $d){	if($d != '0') {set_relation($pdo, "dev_people", "person_id", "developer_id", intval($d), $developer);}}
	foreach($designer as $d){	if($d != '0') {set_relation($pdo, "games_people", "person_id", "game_id", intval($d), $game_id);}}
	foreach($platform as $p){	if($p != '0') {set_relation($pdo, "games_platform", "platform_id", "game_id", intval($p), $game_id);}}
	foreach($genre as $g){		if($g != '0') {set_relation($pdo, "games_genre", "genre_id", "game_id", intval($g), $game_id);}}
}