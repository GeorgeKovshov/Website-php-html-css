

function fill_datalist(e){
	e.preventDefault(); //stops the redirection to the php file
	console.log(e.target.name);
	//let publisher = document.getElementById('company_selector_input').value;
	//let params = "company=" + publisher.value;
	let params = e.target.name + "=" + e.target.value;
	
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