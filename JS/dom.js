//EXAMINE THE DOCUMENT OBJECT IN CONSOLE
/*
//console.dir(document)
console.dir(document);
console.dir(document.domain);
console.dir(document.url);
console.dir(document.title);
//document.title = 123; // those properties can be changed
console.dir(document.doctype);
console.dir(document.head);
console.dir(document.body);
console.dir(document.all);
//document.all[10].textContent = 'Hello'; this method of selecting from the DOM is obsolete
console.log(document.forms);
console.log(document.links);
console.log(document.images);
*/


/*
//console.log(document.getElementById('header-title'));
var headerTitle = document.getElementById('header-title'); // you pick an html element by its id
var header = document.getElementById('main-header');
console.log(headerTitle);
headerTitle.textContent = 'hello'; // you can change the text inside of the picked element
headerTitle.innerText = 'goodbye'; // difference is that textContent disregards style settings, innerText doesn't
headerTitle.innerHTML = '<h3>Hello</h3>' // this puts html code inside of the element
header.style.borderBottom = 'solid 3px #000';
*/


var items = document.getElementsByClassName('list-group-item');
console.log(items);
console.log(items[1]);
items[1].textContent = 'Hello 2';
items[1].style.fontWeight = 'bold';
items[1].style.backgroundColor = 'yellow'; 

function paint(item){
	item.style.backgroundColor = 'red';
}

for(let item of items){
	item.style.backgroundColor = '#f4f4f4';
}
//items.forEach((item) => (item.style.backgroundColor = 'red'));

var input = document.querySelector('input');
input.value = 'Hello World'; // this lets you change the value of elements

var submit = document.querySelector('input[type="submit"]');
submit.value = 'SEND'; // this lets you change the value of elements

var item = document.querySelector('.list-group-item');
item.style.color = 'red'; // this lets you change the value of elements

var lastItem = document.querySelector('.list-group-item:last-child');
lastItem.style.color = 'blue'; // this lets you change the value of elements

var secondItem = document.querySelector('.list-group-item:nth-child(2)');
secondItem.style.color = 'coral'; // this lets you change the value of elements

//QUERYSELECTORALL//
var titles = document.querySelectorAll('.title');
console.log(titles);
titles[0].textContent = 'do it';

var odd = document.querySelectorAll('li:nth-child(odd)');
odd.forEach((item) => item.style.backgroundColor='lightyellow');







