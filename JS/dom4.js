var form = document.getElementById('addForm');
var itemList = document.getElementById('items');
var filter = document.getElementById('filter');


//console.log(itemList.children);


//form submit event
form.addEventListener('submit', addItem);

// delete event
itemList.addEventListener('click', removeItem);

// filter event
filter.addEventListener('keyup', filterItems);


function addItem_mine(e){
	e.preventDefault();
	//var newItem = document.body.children[1].children[0].children[1].children[0];
	var newItem = document.querySelector('input[class="form-control mr-2"]');
	//console.log(newItem.value);
	for(var item of itemList.children){
		if(item.innerText.indexOf("Item") !== -1){
			item.textContent = newItem.value;
			break;
		}
	}
}

//add itemList
function addItem(e){
	e.preventDefault();
	
	
	// Get input value
	var newItem = document.getElementById('item').value;

	
	//create new li element;
	var li = document.createElement('li');
	
	// add class
	li.className = 'list-group-item';
	// add text node with input value
	li.appendChild(document.createTextNode(newItem));
	
	var deleteBtn = document.createElement('button');
	// add classes to del button
	deleteBtn.className = 'btn btn-danger btn-sm float-right delete';
	deleteBtn.appendChild(document.createTextNode('X'));
	
	//append button to li
	li.appendChild(deleteBtn);
	
	//append li to list
	itemList.appendChild(li);
	
}


function removeItem(e){
	if(e.target.classList.contains('delete')){
		if(confirm('Are you sure?')){
			var li = e.target.parentElement;
			itemList.removeChild(li);
		}
	}
	
}

// it matches the letters to ANYWHERE inside the line/item, not just the beginning
function filterItems(e){
	// convert text to lowercase
	var text = e.target.value.toLowerCase();
	//console.log(text);
	var items = itemList.getElementsByTagName('li');
	//console.log(items);
	
	//convert HTMLCollection to an array
	Array.from(items).forEach(function(item){
		var itemName = item.firstChild.textContent;
		//console.log(itemName);
		if(itemName.toLowerCase().indexOf(text) != -1){
			item.style.display = 'block';
		} else {
			item.style.display = 'none';
		}
		
	});
}












