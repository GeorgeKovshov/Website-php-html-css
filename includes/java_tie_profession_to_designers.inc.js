
let amount_professions; // we store the amount of loaded genre selects in memory
if(localStorage.getItem("amount_designer_selectors") === null) {
	amount_professions= 1;		
} else {
	amount_professions = parseInt(localStorage.getItem("amount_designer_selectors"));
}

let java_genre = document.querySelector("#profession_big_selector_div"); // the div holding the selectors and buttons


let java_genre_menu = []; //list of individual selectors


let z = 1;

let designer_div = document.getElementById("designer_big_selector_div");
designer_div.lastChild.addEventListener("click", remove_selector);
designer_div.lastChild.previousSibling.addEventListener("click", add_selector);



function add_genre_selector(i){
	//function that adds a new selector for a genre at a press of a button and at the page load
	java_genre_menu[i] = document.createElement("select");
	java_genre_menu[i].name = "profession" + i.toString();
	
	let option_none = document.createElement("option");
	option_none.value = 0;
	option_none.text = "Empty";
	java_genre_menu[i].appendChild(option_none);
	
	
	for (var key in professions) {
		if (professions.hasOwnProperty(key)) {
			let option = document.createElement("option");
			option.value = key;
			option.text = professions[key];
			//if(subgenres.includes(key.toString()) && subgenres.indexOf(key.toString())==i-1){
				//option.setAttribute("selected", "selected");
				//console.log(`${subgenres.indexOf(key.toString())} and key: ${key} and i: ${i}`);
			//}			
			java_genre_menu[i].appendChild(option);
			//console.log( + " -> " + genres[key]);
		}
	}
	/*
	if(i-1 < subgenres.length && subgenres.keys!=undefined && i-1>=0 && professions.hasOwnProperty(parseInt(subgenres[i-1])) != -1){
		java_genre_menu[i].value = subgenres[i-1];
	}*/
	//java_genre.insertBefore(java_genre_menu[i], btn);
	java_genre.appendChild(java_genre_menu[i]);
	
}


while( z <= amount_professions){
	
	add_genre_selector(z);
	java_genre.appendChild(java_genre_menu[z]);
	z++;
}



function add_selector(e){
	// function for adding selectors
	e.preventDefault();
	if(amount_professions < 10){
		amount_professions++;
		add_genre_selector(amount_professions);

	}
}

function remove_selector(e){
	// function for removing selectors
	e.preventDefault();
	if(amount_professions > 1){
		java_genre.children[amount_professions-1].remove();
		amount_professions--;
	}
}