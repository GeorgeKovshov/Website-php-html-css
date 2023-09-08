<?php

declare(strict_types=1);

function set_designer(object $pdo, string $full_name, int $nationality, string $birthday, string $gender){
	$query = "INSERT INTO people (full_name, nationality, birthday, gender) VALUES (:full_name, :nationality, :birthday, :gender);";
	$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":full_name", $full_name);
	$stmt->bindParam(":nationality", $nationality);
	$stmt->bindParam(":birthday", $birthday);
	$stmt->bindParam(":gender", $gender);
	
	$stmt->execute();
	$stmt = null;
	
}

function get_countries_from_db(object $pdo) {
	$query = "SELECT * FROM Country;";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$result = array();
	$i = 1;
	while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$result[$data["country_id"]] = $data["country_name"];
		////foreach($data as $d){
			//echo $d;
		///}
		///echo $data["country_name"];
	}
	$stmt = null;
	return $result;
}

function get_companies_from_db(object $pdo, int $type) {
	if($type == 2){
		$query = "SELECT publisher_id, title FROM publisher;";
	}
	else {
		$query = "SELECT developer_id, title FROM developer;";
	}
	
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$result = array();
	$i = 1;
	if($type == 1){
		while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$result[$data["developer_id"]] = $data["title"];
		}
	}
	else {
		while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$result[$data["publisher_id"]] = $data["title"];
		}
	}
	
	$stmt = null;
	return $result;
}

function get_genres_from_db(object $pdo) {
	$query = "SELECT genre_id, genre_name FROM genre";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$result = array();
	$i = 1;
	while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$result[$data["genre_id"]] = $data["genre_name"];
	}
	$stmt = null;
	return $result;
}

function get_platforms_from_db(object $pdo) {
	$query = "SELECT platform_id, platform_name FROM platform";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$result = array();
	$i = 1;
	while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$result[$data["platform_id"]] = $data["platform_name"];
	}
	$stmt = null;
	return $result;
}

function get_designers_from_db(object $pdo) {
	$query = "SELECT people_id, full_name FROM people";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$result = array();
	$i = 1;
	while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$result[$data["people_id"]] = $data["full_name"];
	}
	$stmt = null;
	return $result;
}


function get_name(object $pdo, string $current_name, string $name, string $table) {
	$query = "SELECT $name FROM $table WHERE $name = :current_name;";
	$stmt = $pdo->prepare($query);
	//$stmt->bindParam(':name', $name);
	//$stmt->bindParam(':table', $table);
	$stmt->bindParam(":current_name", $current_name);
	$stmt->execute();
	
	
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt = null;
	return $result;
}

function get_id(object $pdo, string $current_name, string $name, string $table, string $id_column) {
	$query = "SELECT $id_column FROM $table WHERE $name = :current_name;";
	$stmt = $pdo->prepare($query);
	//$stmt->bindParam(':name', $name);
	//$stmt->bindParam(':table', $table);
	$stmt->bindParam(":current_name", $current_name);
	$stmt->execute();
	
	
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt = null;
	return intval($result[$id_column]);
}



function set_company(object $pdo, string $company_name, int $country, string $company_type, string $founded, string $closed){
	if($closed == "1") {
		$query = "INSERT INTO $company_type (title, country, founded, closed) VALUES (:title, :country, :founded, NULL);";
		$stmt = $pdo->prepare($query);
	}
	else{
		$query = "INSERT INTO $company_type (title, country, founded, closed) VALUES (:title, :country, :founded, :closed);";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(":closed", $closed);
	}
	//$query = "INSERT INTO $company_type (title, country, founded, closed) VALUES (:title, :country, :founded, :closed);";
	//$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":title", $company_name);
	$stmt->bindParam(":country", $country);
	$stmt->bindParam(":founded", $founded);
	
	
	
	$stmt->execute();
	$stmt = null;
	
}

function set_platform(object $pdo, string $platform_name, int $company, int $generation, string $released, string $discontinued){
	if($discontinued == "1") {
		$query = "INSERT INTO platform (platform_name, company, generation, released, discontinued) VALUES (:platform_name, :company, :generation, :released, NULL);";
		$stmt = $pdo->prepare($query);
	}
	else{
		$query = "INSERT INTO platform (platform_name, company, generation, released, discontinued) VALUES (:platform_name, :company, :generation, :released, :discontinued);";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(":discontinued", $discontinued);
	}

	///$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":platform_name", $platform_name);
	$stmt->bindParam(":company", $company);
	$stmt->bindParam(":generation", $generation);
	$stmt->bindParam(":released", $released);
	
	
	
	$stmt->execute();
	$stmt = null;
	
}

function set_genre(object $pdo, string $genre_name, string $genre_description, int $subgenre){
	$query = "INSERT INTO genre (genre_name, subgenre_of, genre_description) VALUES (:genre_name, :subgenre, :genre_description);";

	$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":genre_name", $genre_name);
	$stmt->bindParam(":subgenre", $subgenre);
	$stmt->bindParam(":genre_description", $genre_description);
	
	
	
	$stmt->execute();
	$stmt = null;
	
}

function set_game(object $pdo, string $game_title, string $series_title, string $released, int $developer, int $publisher, int $score, string $game_description){
	$query = "INSERT INTO games(game_title, release_date, game_description, series, score, developer, publisher) VALUES (:game_title, :released, :game_description, :series_title, :score, :developer, :publisher);";

	$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":game_title", $game_title);
	$stmt->bindParam(":released", $released);
	$stmt->bindParam(":game_description", $game_description);
	$stmt->bindParam(":series_title", $series_title);
	$stmt->bindParam(":score", $score);
	
	$stmt->bindParam(":developer", $developer);
	$stmt->bindParam(":publisher", $publisher);
	
	
	$stmt->execute();
	$stmt = null;
}

function check_relation_exists(object $pdo, string $table_name, string $column_one_name, string $column_two_name, int $column_one_value, int $column_two_value) {
	$query = "SELECT $column_one_name FROM $table_name WHERE $column_one_name = :column_one_value AND $column_two_name = :column_two_value;";

	$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":column_one_value", $column_one_value);
	$stmt->bindParam(":column_two_value", $column_two_value);
	
	$stmt->execute();
	
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt = null;
	return $result;
}

function set_relation(object $pdo, string $table_name, string $column_one_name, string $column_two_name, int $column_one_value, int $column_two_value){
	if(!check_relation_exists($pdo, $table_name, $column_one_name, $column_two_name, $column_one_value, $column_two_value)){
		$query = "INSERT INTO $table_name ($column_one_name, $column_two_name) VALUES (:column_one_value, :column_two_value);";

		$stmt = $pdo->prepare($query);
		
		$stmt->bindParam(":column_one_value", $column_one_value);
		$stmt->bindParam(":column_two_value", $column_two_value);
		
		$stmt->execute();
		$stmt = null;
	}
	
	
}




