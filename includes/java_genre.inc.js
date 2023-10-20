console.log(genres);
let amount_java_genre;
if(localStorage.getItem("amount_java_genre") === null) {
	amount_java_genre = 1;		
} else {
	amount_java_genre = parseInt(localStorage.getItem("amount_java_genre"));
}
let java_genre = document.querySelector("#java_genre");
console.log(java_genre);

let java_genre_menu = [];


let i = 1;
let selects = [];

var btn = document.createElement("button");
java_genre.appendChild(btn);
btn.appendChild(document.createTextNode("+"));
btn.setAttribute("style", "padding:2px 5px;");
btn.setAttribute("id", "java_button");
btn.addEventListener("click", add_selector);

var btn2 = document.createElement("button");
java_genre.appendChild(btn2);
btn2.appendChild(document.createTextNode("-"));
btn2.setAttribute("style", "padding:2px 7px;");
btn2.addEventListener("click", remove_selector);

function add_genre_selector(i){
	//function that adds a new selector for a genre at a press of a button and at the page load
	java_genre_menu[i] = document.createElement("select");
	java_genre_menu[i].name = "subgenre" + i.toString();
	
	let option_none = document.createElement("option");
	option_none.value = 0;
	option_none.text = "None";
	java_genre_menu[i].appendChild(option_none);
	
	for (var key in genres) {
		if (genres.hasOwnProperty(key)) {
			let option = document.createElement("option");
			option.value = key;
			option.text = genres[key];
			java_genre_menu[i].appendChild(option);
			//console.log( + " -> " + genres[key]);
		}
	}
	
	java_genre.insertBefore(java_genre_menu[i], btn);
	//java_genre.appendChild(java_genre_menu[i]);
	
}


while( i <= amount_java_genre){
	add_genre_selector(i);
	java_genre.insertBefore(java_genre_menu[i], btn);
	//java_genre.appendChild(java_genre_menu[i]);
	
	i++;
}
console.log(selects);
for (var key in genres) {
	if (genres.hasOwnProperty(key)) {
		console.log(key + " -> " + genres[key]);
	}
}

console.log(java_genre.children[amount_java_genre + 2]);





function add_selector(e){
	e.preventDefault();
	amount_java_genre++;
	add_genre_selector(amount_java_genre);
	console.log(amount_java_genre);
	localStorage.setItem("amount_java_genre", amount_java_genre.toString());
}

function remove_selector(e){
	e.preventDefault();
	java_genre.children[amount_java_genre + 1].remove();
	amount_java_genre--;
	console.log(amount_java_genre);
	localStorage.setItem("amount_java_genre", amount_java_genre.toString());
}

  


