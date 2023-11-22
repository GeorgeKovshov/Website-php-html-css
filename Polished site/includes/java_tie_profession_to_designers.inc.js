console.log(set_professions);
let amount_professions; // we store the amount of loaded profession selects in memory
if(localStorage.getItem("amount_designer_selectors") === null) {
	amount_professions= 1;		
} else {
	amount_professions = parseInt(localStorage.getItem("amount_designer_selectors"));
}

let java_profession = document.querySelector("#profession_big_selector_div"); // the div holding the selectors and buttons


let java_profession_menu = []; //list of individual selectors


let z = 1;

let designer_div = document.getElementById("designer_big_selector_div");
designer_div.lastChild.addEventListener("click", remove_selector);
designer_div.lastChild.previousSibling.addEventListener("click", add_selector);



function add_profession_selector(i){
	//function that adds a new selector for a profession at a press of a button and at the page load
	java_profession_menu[i] = document.createElement("select");
	java_profession_menu[i].name = "profession" + i.toString();
	
	let option_none = document.createElement("option");
	option_none.value = 0;
	option_none.text = "Empty";
	java_profession_menu[i].appendChild(option_none);
	
	
	for (var key in professions) {
		if (professions.hasOwnProperty(key)) {
			let option = document.createElement("option");
			option.value = key;
			option.text = professions[key];		
			java_profession_menu[i].appendChild(option);
		}
	}
	
	//this choses the already chosen professions before the submit button was pressed
	if(typeof(set_professions) !== "undefined" && set_professions !== "" &&i-1 < set_professions.length && i-1>=0 && professions.hasOwnProperty(parseInt(set_professions[i-1])) != -1){
		java_profession_menu[i].value = set_professions[i-1];
	}
	//java_profession.insertBefore(java_profession_menu[i], btn);
	java_profession.appendChild(java_profession_menu[i]);
	
}


while( z <= amount_professions){
	
	add_profession_selector(z);
	java_profession.appendChild(java_profession_menu[z]);
	z++;
}



function add_selector(e){
	// function for adding selectors
	e.preventDefault();
	if(amount_professions < 10){
		amount_professions++;
		add_profession_selector(amount_professions);

	}
}

function remove_selector(e){
	// function for removing selectors
	e.preventDefault();
	if(amount_professions > 1){
		java_profession.children[amount_professions-1].remove();
		amount_professions--;
	}
}