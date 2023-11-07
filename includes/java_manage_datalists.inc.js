
//let category = list_of_categories[2];
// list_of_categories is a passed array to this file of which datalist selectors to add
let amount_selectors = []; // array of how many selectors for each catagory there are
let container_java = []; // array of divs holding each category block (with buttons, datalists and input fields
let btn = []; // array of plus buttons
let btn2 = []; // array of minus buttons


let length = list_of_categories.length;
let i = 0;
while (i < length){
	// we go through the passed array and create selectors, divs and buttons for each
	let category = list_of_categories[i];

	// using local storage to save the amount of the created selectors
	if(localStorage.getItem("amount_" + category + "_selectors") === null) {
		amount_selectors.push(1);		
	} else {
		amount_selectors.push(parseInt(localStorage.getItem("amount_" + category + "_selectors")));
	}
	
	container_java.push(document.querySelector("#" + category + "_big_selector_div")); // the div holding the selectors and buttons
	
	//adding + button
	btn.push(document.createElement("button"));
	container_java[i].appendChild(btn[i]);
	btn[i].appendChild(document.createTextNode("+"));
	btn[i].setAttribute("style", "padding:2px 5px;");
	btn[i].setAttribute("id", "java_button");
	btn[i].addEventListener("click", add_selector);
	
	//adding - button
	btn2.push(document.createElement("button"));
	container_java[i].appendChild(btn2[i]);
	btn2[i].appendChild(document.createTextNode("-"));
	btn2[i].setAttribute("style", "padding:2px 7px;");
	btn2[i].addEventListener("click", remove_selector);
	
	let j = 1;

	while( j <= amount_selectors[i]){
		// creating the appropriate amount of selectors for given category
		add_datalist(j, category);
		j++;
	}
	
	i++;
}


function add_datalist(i, category){
	//function that adds a new selector for a category a press of a button and at the page load
	
	name = category + i.toString();

	// creating a div for individual category selector
	let sel_list  = document.createElement("div");
	sel_list .name = name + "_selector_div";
	
	let input_field = document.createElement("input");
	input_field.setAttribute("list", name + "_selector_datalist");
	input_field.name = name;
	input_field.id = name + "_selector_input";
	sel_list .appendChild(input_field);
	
	let datalist_field = document.createElement("datalist");
	datalist_field.id = name + "_selector_datalist";
	sel_list .appendChild(datalist_field);
	
	//inserting the new div into the big_selector_div of category
	ind = list_of_categories.indexOf(category);
	container_java[ind].insertBefore(sel_list, btn[ind]);
	document.querySelector("#" + name + "_selector_input").addEventListener("keyup", fill_datalist);
	
}




function fill_datalist(e){
	e.preventDefault(); //stops the redirection to the php file	
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
				console.log(typeof(results));
				
				let output = '';
				for(let i in results) {
					for(let t in results[i]){
						output += '<option value="' +  results[i][t] + '">';
					}
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
	//subtracting the category from id
	let category = e.target.parentNode.id
	category = category.substr(0, category.indexOf('_'))
	
	//finding the index of the targetted category in main array
	ind = list_of_categories.indexOf(category)
	
	if(amount_selectors[ind] < 9){
		amount_selectors[ind]++;
		add_datalist(amount_selectors[ind], category);
		localStorage.setItem("amount_" + category + "_selectors", amount_selectors[ind].toString());
	}
}

function remove_selector(e){
	// function for removing selectors
	e.preventDefault();
	
	//subtracting the category from id
	let category = e.target.parentNode.id
	category = category.substr(0, category.indexOf('_'))
	
	//finding the index of the targetted category in main array
	ind = list_of_categories.indexOf(category)
	
	if(amount_selectors[ind]> 1){
		container_java[list_of_categories.indexOf(category)].children[amount_selectors[ind]-1].remove();
		amount_selectors[ind]--;
		localStorage.setItem("amount_" + category + "_selectors", amount_selectors[ind].toString());
	}
}

