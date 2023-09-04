<?php

declare(strict_types=1);


function input_designer(object $pdo, string $full_name, int $nationality, string $birthday, string $gender){
	set_designer($pdo, $full_name, $nationality, $birthday, $gender);
		
}

function get_countries(object $pdo){
	return get_countries_from_db($pdo);
}

function get_companies(object $pdo){
	return get_companies_from_db($pdo);
}

function is_input_empty(array $inputs){
	foreach($inputs as $input){
		if(empty($input)){
			return true;
		}
		
	}
	return false;
		
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