//Traversing the DOM
var itemList = document.querySelector('#items'); // we are grabbing elements with id items
console.log(itemList.parentNode);
itemList.parentNode.style.backgroundColor = '#f4f4f4';


//Traversing the DOM
var itemList = document.querySelector('#items'); // we are grabbing elements with id items
console.log(itemList.parentElement);
itemList.parentElement.parentElement.style.backgroundColor = '#f4f4f4';

//childNodes
console.log(itemList.childNodes);

console.log(itemList.children); //this one is better, does the same
itemList.children[1].style.backgroundColor = 'lightyellow';

console.log(itemList.firstChild); //you think it grabs first item, but here it grabs the whitespace between lines
console.log(itemList.firstElementChild); // this one grabs what you'd expect
itemList.lastElementChild.textContent = 'Hello 4';

//siblings
console.log(itemList.nextSibling);
console.log(itemList.nextElementSibling);

console.log(itemList.previousSibling);
console.log(itemList.previousElementSibling);
itemList.previousElementSibling.style.color = 'green';


//create a div
var newDiv = document.createElement('div');
// add class
newDiv.className = 'hello';
// add id
newDiv.id = 'hello1';
//add attributes
newDiv.setAttribute('title', 'Hello Div');
//create text node
var newDivText = document.createTextNode('Hello text');

//add text to div
newDiv.appendChild(newDivText);

var container = document.querySelector('header .container');
var h1 = document.querySelector('header h1');

console.log(newDiv);
newDiv.style.fontSize = '30px';

container.insertBefore(newDiv, h1);






console.log(newDiv);