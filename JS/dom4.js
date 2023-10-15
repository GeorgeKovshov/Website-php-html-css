var form = document.getElementById('addForm');
var itemList = document.getElementById('items');

console.log(itemList.children);
//form submit event

form.addEventListener('submit', addItem);

//add itemList
function addItem(e){
	e.preventDefault();
	
	// Get input value
	//var newItem = document.getElementById('item');
	//var newItem = document.body.children[1].children[0].children[1].children[0];
	var newItem = document.querySelector('input[class="form-control mr-2"]');
	console.log(newItem.value);
	
	for(var item of itemList.children){
		if(item.innerText.indexOf("Item") !== -1){
			item.textContent = newItem.value;
			break;
		}
	}
	//itemList.children[1].textContent = newItem.value;
	console.log(itemList.children[1]);
}