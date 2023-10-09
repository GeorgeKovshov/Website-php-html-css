/*alert('Hello World');
clear();
console.log('Hello World');
console.error('This is an error');
console.warn('this is a warning');
*/



//var, let and const
//var is not used today, its a global variable, can cause problems

// let allows to reassign values;

let age = 30;
age = 31;
const age2 = 32; // you cant change it later;

console.log(age); //to print in console use this function

// data types: String, Numbers, Boolean, null, undefined, Symbol

const name = 'John';
const isCool = true;
const rating = 4.5; // there's no float or int, there are just numbers in js
const nul = null;
const undef = undefined;
let z; //declaring z as undefined;

console.log(typeof rating);

//Concatenation
console.log('My name is' +  name + ' and I am ' +  age);
// Template Strings
const hello = `My name is ${name} and I am ${age}`; //those are backticks, not quotes - they are on 'ё'
console.log(hello);

const s = 'Hello, World';
console.log(s.length);
console.log(s.toLowerCase());
console.log(s.substring(0, 5).toUpperCase());
console.log(s.split('')); // split word in array of letters
console.log(s.split(', '));


// Arrays

const numbers = new Array();
const fruits = ['apples', 'oranges', 'pears', true, 10];
fruits[5] = 'grapes'; // you can add to const arrays

fruits.push('mangos');
fruits.unshift('strawberries');
fruits.pop();
console.log(Array.isArray(fruits));
console.log(fruits.indexOf('oranges'));
console.log(fruits);

//object literals
const person = {
	firstName: 'John',
	lastName: 'Doe',
	age: 30,
	hobbies: ['music', 'movies', 'sports'],
	address: {
		street: '50 main st',
		city: 'Boston',
		state: 'MA'
	}
	
}

console.log(person.hobbies[1]);

const { firstName, lastName, address: {city}} = person; //pulling data out of person

console.log(city);

const todos = [
	{
		id:1,
		text: 'Take out the trash',
		isCompleted: true
	},
	{
		id:2,
		text: 'Meet with the boss',
		isCompleted: true
	},
	{
		id:3,
		text: 'Dentish appointment',
		isCompleted: false
	}
];

console.log(todos[1].text);

const todoJSON = JSON.stringify(todos); //turns object literals into JSON
console.log(todoJSON);

for(let i = 0; i < 10; i++){
	// do something
}
let i = 0;
while(i<10){
	i++;
}

for(let todo of todos){
	console.log(todo);
}


//forEach, map, filter

todos.forEach(function(todo){
	console.log(todo.text);	
}); // forEach takes a function as a parameter and does something for each member of array


const todoText = todos.map(
	function(todo){
		return todo.text
	}
);// map returns the specified in function values and forms an array of them

const todoText2 = todos.filter(
	function(todo){
		return todo.isCompleted === true;
	}
); //filter returns those objects in array that have the returned in function value set to true



// conditionals

const x = 10;

if(x === 10) { // == matches the values, not types; === ensures that both the type and value are the same
	console.log('x is 10');
} else if (x == 10){
	console.log('x is 10 but not a number');
}

const y = 11;
if(x > 5 || y > 10){
	console.log('x is more than 5 or y is more than 10');
}


// the turnary operator '?'
const color = x > 10 ? 'red' : 'blue';
console.log(color);


//switch
switch(color) {
	case 'red':
		console.log('color is red');
		break;
	case 'blue':
		console.log('color is blue');
		break;
	default:
		console.log('color is not blue or red');
		break;
}

//function
function addNums1(num1, num2) {
	return num1 + num2
}
console.log(addNums1(1,2));

//arrow funcitons
const addNums = (num1 = 1, num2 = 2) => {
	console.log('arrow function');
	console.log( num1 + num2);
}
addNums(5, 5);

const addNumsShort = (num1 = 1, num2 = 2) => num1 + num2; //if one line, you can return result like this
const addNumsFive = num1 => num1 + 5;
console.log(addNumsShort(3, 5));

todos.forEach((todo) => console.log(todo));


//classes

/*
//Constructor function
function Person(firstName, lastName, dob) {
	this.firstName = firstName;
	this.lastName = lastName;
	this.dob = new Date(dob);
	
	
	this.getFullName = function(){
		return `${this.firstName} ${this.lastName}`;
	}
}

Person.prototype.getBirthYear = function(){ //prototype is the class method outside of class object
	return this.dob.getFullYear();
}

//instantiate an object
const person1 = new Person('John', 'Doe', '4-3-1980');

console.log(person1);
console.log(`${person1.getFullName()} is born ${person1.getBirthYear()}`);
*/

class Person{
	constructor(firstName, lastName, dob){
		this.firstName = firstName;
		this.lastName = lastName;
		this.dob = new Date(dob);
	}
	
	getFullName() {
		return `${this.firstName} ${this.lastName}`;
	}
	
	getBirthYear() {
		return this.dob.getFullYear();
	}
}

//instantiate an object
const person1 = new Person('John', 'Doe', '4-3-1980');

console.log(person1);
console.log(`${person1.getFullName()} is born ${person1.getBirthYear()}`);



//Now..... the DOM!!












