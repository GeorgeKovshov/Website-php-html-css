
let publisher = document.getElementById('company_selector_input');
if(company_selected != "none"){
	publisher.setAttribute("value", company_selected);
}
publisher.addEventListener('keyup', platform_find_company);

let developer = document.getElementById('developer_selector_input');
if(developer_selected != "none"){
	developer.setAttribute("value", developer_selected);
}
developer.addEventListener('keyup', platform_find_company);

function platform_find_company(e){
	e.preventDefault(); //stops the redirection to the php file
	console.log(e.target.name);
	//let publisher = document.getElementById('company_selector_input').value;
	//let params = "company=" + publisher.value;
	let params = e.target.name + "=" + e.target.value;
	
	let xhr = new XMLHttpRequest();
	xhr.open('POST', 'includes/java_platform.inc.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			console.log(this.responseText);
			if(this.responseText != ""){
				let companies = JSON.parse(this.responseText);
				//console.log(user.name);
				
				let output = '';
				for(let i in companies) {
					output += '<option value="' +  companies[i].title + '">';
				}			
				document.getElementById(e.target.name + '_selector_datalist').innerHTML = output;
			}
		}
	}
	xhr.send(params);

}