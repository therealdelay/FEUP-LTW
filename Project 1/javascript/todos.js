let addButton = document.querySelector("img");
let form = document.getElementById("add_form");
let todos = document.getElementById("todos_only");

let pathArray = document.URL.split( '?' );
let list_id = pathArray[1].split('=')[1][0];
/**
	Event to get the form once the add list button is clicked
*/
addButton.addEventListener("click", getForm);
/**
	Gets the form to add a todo
*/
function getForm(event){
	form.style.display = "inline";
	todos.style.opacity = "0.5";
}

function addRemoveButtonsListeners(){
	for(let i = 0; i < todoRemoveButtons.length; i++){
		todoRemoveButtons[i].addEventListener("click",function(){
			console.log(list_id);
			console.log(this.parentNode.parentNode.id);
			let request = new XMLHttpRequest();
			request.addEventListener("load", todoRemoved);
			let link = "remove_todo.php?list_id="+list_id+"&todo_id="+this.parentNode.parentNode.id;
			console.log(link);
			request.open("get", "remove_todo.php?list_id="+list_id+"&todo_id="+this.parentNode.parentNode.id, true);
			request.send();
			//this.parentNode.parentNode.remove();
		});
	}
}

function addEditButtonsListeners(){
	for(let i = 0; i < todoEditButtons.length; i++){
		todoEditButtons[i].addEventListener("click",function(){
			console.log("Edit");
		});
	}
}

function addDoneButtonsListeners(){
	for(let i = 0; i < todoDoneButtons.length; i++){
		todoDoneButtons[i].addEventListener("click",function(){
			console.log("Done");
		});
	}
}


// Add Todo Form Selectors
let todoNameText = document.querySelector("#add_form input[name='name']");
let todoDateText = document.querySelector("#add_form input[name='date']");

// Add Todo Button Selectors 
let addTodoButton = document.querySelector("input[value='Add']");
let cancelTodoButton = document.querySelector("input[value='Cancel']");

// Todos Selectors
let todoEditButtons = document.querySelectorAll(".todo_only button[name='Edit']");
let todoDoneButtons = document.querySelectorAll(".todo_only button[name='Done']");
let todoRemoveButtons = document.querySelectorAll(".todo_only button[name='Remove']");


addEditButtonsListeners();
addDoneButtonsListeners();
addRemoveButtonsListeners();

/**]
	Event once the add button on the form is clicked. It add the new todo to the database
*/
addTodoButton.addEventListener("click",function(event){
	let request = new XMLHttpRequest();
	request.addEventListener("load", todosReceived);
	request.open("get", "add_todo.php?name="+todoNameText.value+"&date="+todoDateText.value+"&list_id="+list_id, true);
	request.send();
});

/**
	Once the cancel button is clicked, it will go back to the list view
*/
cancelTodoButton.addEventListener("click",function(event){
	form.style.display = "none";
	todos.style.opacity = "1";
});

function todoRemoved(){
	console.log(this.responseText);
	location.reload();
}

/**
	Reloads the location to show the new lists added
*/
function todosReceived(){
	todos.style.opacity = "1";
	location.reload();
}