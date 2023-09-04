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

function get_companies_from_db(object $pdo) {
	$query = "SELECT publisher_id, title FROM publisher;";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$result = array();
	$i = 1;
	while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$result[$data["publisher_id"]] = $data["title"];
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



function set_company(object $pdo, string $company_name, int $country, string $company_type, string $founded, string $closed){
	if($closed == "1") {
		$query = "INSERT INTO $company_type (title, country, founded, closed) VALUES (:title, :country, :founded, NULL);";
	}
	else{
		$query = "INSERT INTO $company_type (title, country, founded, closed) VALUES (:title, :country, :founded, $closed);";
	}
	//$query = "INSERT INTO $company_type (title, country, founded, closed) VALUES (:title, :country, :founded, :closed);";
	$stmt = $pdo->prepare($query);
	
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






