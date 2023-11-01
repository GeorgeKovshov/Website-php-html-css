let selector_div = document.getElementById('company_selector');
console.log(company_selected);

let publisher = document.getElementById('company_selector_input');
if(company_selected != "none"){
	//publisher = company_selected
	publisher.setAttribute("value", company_selected);
}
publisher.addEventListener('keyup', platform_find_company);
function platform_find_company(e){
	e.preventDefault(); //stops the redirection to the php file
	
	//let publisher = document.getElementById('company_selector_input').value;
	let params = "publisher=" + publisher.value;
	
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
				document.getElementById('company_selector_datalist').innerHTML = output;
			}
		}
	}
	xhr.send(params);

}