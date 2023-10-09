// the DOM
/* here's the DOM */

//DOM - document object model

//console.log(window);


//Single element selectors
console.log(document.getElementById('my-form'));
const form = document.getElementById('my-form');

console.log(document.querySelector('.container'));

// Multiple element selectors

console.log(document.querySelectorAll('.item'));

console.log(document.getElementsByClassName('item'));
//console.log(document.getElementsByTagName('li'));

const items = document.querySelectorAll('.item');

items.forEach((item) => console.log(item));
