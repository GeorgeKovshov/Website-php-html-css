
let amount_selectors; // we store the amount of loaded genre selects in memory
if(localStorage.getItem("amount_selectors") === null) {
	amount_selectors = 1;		
} else {
	amount_selectors = parseInt(localStorage.getItem("amount_selectors"));
}

console.log(amount_selectors);

let container_java = document.querySelector("#" + category + "_big_selector_div"); // the div holding the selectors and buttons



let selectors_list = []; //list of individual genre selectors

//initializing buttons "+" and "-"
var btn = document.createElement("button");
container_java.appendChild(btn);
btn.appendChild(document.createTextNode("+"));
btn.setAttribute("style", "padding:2px 5px;");
btn.setAttribute("id", "java_button");
btn.addEventListener("click", add_selector);

var btn2 = document.createElement("button");
container_java.appendChild(btn2);
btn2.appendChild(document.createTextNode("-"));
btn2.setAttribute("style", "padding:2px 7px;");
btn2.addEventListener("click", remove_selector);


let i = 1;


while( i <= amount_selectors){
	add_datalist(i);
	container_java.insertBefore(selectors_list[i], btn);
	i++;
}


function add_datalist(i){
	//function that adds a new selector for a category a press of a button and at the page load
	
	
	name = category + i.toString();
	selectors_list[i] = document.createElement("div");
	selectors_list[i].name = name + "_selector_div";
	
	let input_field = document.createElement("input");
	input_field.setAttribute("list", name + "_selector_datalist");
	input_field.name = name;
	input_field.id = name + "_selector_input";
	selectors_list[i].appendChild(input_field);
	
	let datalist_field = document.createElement("datalist");
	datalist_field.id = name + "_selector_datalist";
	selectors_list[i].appendChild(datalist_field);
	
	
	container_java.insertBefore(selectors_list[i], btn);
	document.querySelector("#" + name + "_selector_input").addEventListener("keyup", fill_datalist);
	//java_genre.appendChild(java_genre_menu[i]);
	
}




function fill_datalist(e){
	e.preventDefault(); //stops the redirection to the php file
	
	//let publisher = document.getElementById('company_selector_input').value;
	//let params = "company=" + publisher.value;
		
	let params = e.target.name.replace(/[0-9]/g, '') + "=" + e.target.value;
	console.log(params);
	let xhr = new XMLHttpRequest();
	xhr.open('POST', 'includes/query_top_10_for_ajax.inc.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			console.log(this.responseText);
			if(this.responseText != ""){
				let results = JSON.parse(this.responseText);
				//console.log(user.name);
				console.log(typeof(results));
				
				let output = '';
				for(let i in results) {
					for(let t in results[i]){
						//console.log("-->" + results[i][t]);
						output += '<option value="' +  results[i][t] + '">';
					}
					
					//output += '<option value="' +  results[i].title + '">';
				}			
				document.getElementById(e.target.name + '_selector_datalist').innerHTML = output;
			}
		}
	}
	xhr.send(params);

}


function add_selector(e){
	// function for adding selectors
	e.preventDefault();
	if(amount_selectors < 10){
		amount_selectors++;
		add_datalist(amount_selectors);
		localStorage.setItem("amount_selectors", amount_selectors.toString());
	}
}

function remove_selector(e){
	// function for removing selectors
	e.preventDefault();
	if(amount_selectors > 1){
		container_java.children[amount_selectors-1].remove();
		amount_selectors--;
		localStorage.setItem("amount_selectors", amount_selectors.toString());
	}
}

