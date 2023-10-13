//events

//you can add onClick="buttonClick(1)" attribute to button to invoke this function
function buttonClick1(){
	//console.log("button click");
	document.getElementById('header-title').textContent = 'Changed';
	document.querySelector('#main').style.backgroundColor = 'lightgrey';
	
}

// it works without e, but event parameter carries a lot of information
function buttonClick(e){
	//console.log(e);
	console.log(e.target); // e.target will give whatever element the event is fired from
	console.log(e.target.id);
	var output = document.getElementById('output');
	output.innerHTML = `<h3> ${e.target.id} </h3>`; //'<h3>' + e.target.id + '</h3>';
	
	console.log(e.type);// e.type gives back whatever type of event this is
	console.log(e.clientX); // the mouse position inside the browser window
	console.log(e.clientY);
	
	console.log(e.offsetY); // offset is from within the object thats clicked
	
	console.lot(e.altKey); // whether the right button is clicked/held
	console.lot(e.ShiftKey); // check whether the shift was held while clicking the button
}


var button = document.getElementById('button').addEventListener
('click', function(){
	console.log(123);
});

//same as above, only we use named function
var button = document.getElementById('button').addEventListener
('click', buttonClick);


var button = document.getElementById('button');
var box = document.getElementById('box');

//button.addEventListener('click', runEvent);
//button.addEventListener('dblclick', runEvent);
//button.addEventListener('mousedown', runEvent);
//button.addEventListener('mouseup', runEvent);

//box.addEventListener('mouseenter', runEvent);
//box.addEventListener('mouseleave', runEvent);
//box.addEventListener('mouseover', runEvent); // fires off not only when entering, but also when hovering over inner objects, like letters
//box.addEventListener('mouseout', runEvent);
//box.addEventListener('mousemove', runEvent);


var itemInput = document.querySelector('input[type="text"]');
var form = document.querySelector('form');

var select = document.querySelector('select');

//itemInput.addEventListener('keydown', runEvent2);
//itemInput.addEventListener('keyup', runEvent2);
itemInput.addEventListener('keypress', runEvent2);

itemInput.addEventListener('focus', runEvent); //focus is when you click inside of the object
itemInput.addEventListener('blur', runEvent); //is the opposite - it's when you click out of the focused object 

itemInput.addEventListener('cut', runEvent); // fires off when someone cuts the typed info inside object
itemInput.addEventListener('paste', runEvent); 

itemInput.addEventListener('input', runEvent); // fires off when we do anything: type, cut, paste, etc.

select.addEventListener('change', runEvent);


form.addEventListener('submit', runEvent);


function runEvent(e){
	e.preventDefault();
	console.log('EVENT TYPE: ' + e.type);
	
	console.log(e.target.value);
	output.innerHTML = '<h3>MouseX: ' +e.offsetX + ' </h3><h3>MouseY: ' + e.offsetY + ' </h3>';
	box.style.backgroundColor = "rgb("+ e.offsetX +"," + e.offsetY + ", 40" + ")";
	document.body.style.backgroundColor = "rgb("+ e.offsetX +"," + e.offsetY + ", 40" + ")";
}

function runEvent2(e){
	console.log('EVENT TYPE: ' + e.type);
	
	console.log(e.target.value)
	document.getElementById('output').innerHTML = '<h3>' + e.target.value + '</h3>';
	output.innerHTML = '<h3>MouseX: ' +e.offsetX + ' </h3><h3>MouseY: ' + e.offsetY + ' </h3>';
	box.style.backgroundColor = "rgb("+ e.offsetX +"," + e.offsetY + ", 40" + ")";
	document.body.style.backgroundColor = "rgb("+ e.offsetX +"," + e.offsetY + ", 40" + ")";
}










