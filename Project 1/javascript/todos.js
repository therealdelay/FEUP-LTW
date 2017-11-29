let addButton = document.querySelector("img");
let form = document.getElementById("add_form");
let todos = document.getElementById("todos_only");

let pathArray = document.URL.split( '?' );
let list_id = pathArray[1].split('=')[1];
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

let todoNameText = document.querySelector("#add_form input[name='name']");
let todoDateText = document.querySelector("#add_form input[name='date']");
let addTodoButton = document.querySelector("input[value='Add']");
let cancelTodoButton = document.querySelector("input[value='Cancel']");

/**
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

/**
	Reloads the location to show the new lists added
*/
function todosReceived(){
	todos.style.opacity = "1";
	location.reload();
}