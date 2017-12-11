let addButton = document.querySelector("#ultimo a");
let addForm = document.getElementById("add_form");
let editForm = document.getElementById("edit_form");
let todos = document.getElementById("todos_only");

let pathArray = document.URL.split( '?' );
let list_id = pathArray[1].split('=')[1].split('#')[0];

let selectedTodoId = null;

let selectedTodo = null;
/**
	Event to get the form once the add list button is clicked
*/
addButton.addEventListener("click", getAddForm);

/**
	Gets the form to add a todo
*/
function getAddForm(event){
	addForm.style.display = "inline";
	todos.style.opacity = "0.5";
}

function getEditForm(){
	editForm.style.display = "inline";
	todos.style.opacity = "0.5";
}

function addRemoveButtonsListeners(){
	for(let i = 0; i < todoRemoveButtons.length; i++){
		todoRemoveButtons[i].addEventListener("click",function(){
			let request = new XMLHttpRequest();
			request.addEventListener("load", todoRemoved);
			request.open("get", "remove_todo.php?list_id="+list_id+"&todo_id="+this.parentNode.id, true);
			request.send();
			//this.parentNode.parentNode.remove();
		});
	}
}

function addEditButtonsListeners(){
	for(let i = 0; i < todoEditButtons.length; i++){
		todoEditButtons[i].addEventListener("click",function(){
			selectedTodoId = this.parentNode.id;
			todoEditNameText.value = this.parentNode.childNodes[1].innerHTML;
			todoEditDateText.value = this.parentNode.childNodes[3].innerHTML;
			getEditForm();
		});
	}
}

function addDoneButtonsListeners(){
	for(let i = 0; i < todoDoneButtons.length; i++){
		todoDoneButtons[i].addEventListener("click",function(){
			selectedTodo = this.parentNode;
			let request = new XMLHttpRequest();
			request.addEventListener("load", todoUpdated);
			request.open("get", "update_todo.php?todo_id="+this.parentNode.id, true);
			request.send();
		});
	}
}


// Add Todo Form Selectors
let todoNameText = document.querySelector("#add_form input[name='name']");
let todoDateText = document.querySelector("#add_form input[name='date']");

// Add Todo Form Button Selectors 
let addTodoButton = document.querySelector("#add_form input[value='Add']");
let cancelTodoButton = document.querySelector("#add_form input[value='Cancel']");

// Edit Todo Form Selectors
let todoEditNameText = document.querySelector("#edit_form  input[name='name']");
let todoEditDateText = document.querySelector("#edit_form input[name='date']");

// Edit Form Button Selectors 
let saveTodoEditButton = document.querySelector("#edit_form input[value='Save']");
let cancelTodoEditButton = document.querySelector("#edit_form input[value='Cancel']");

// Todos Selectors
let todoEditButtons = document.querySelectorAll(".todo_only button[name='Edit']");
let todoDoneButtons = document.querySelectorAll(".todo_only button[name='Check']");
let todoRemoveButtons = document.querySelectorAll(".todo_only button[name='Remove']");


addEditButtonsListeners();
addDoneButtonsListeners();
addRemoveButtonsListeners();



//Add Form Buttons Listeners

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
	todoNameText.value = "";
	todoDateText.value = "";
	addForm.style.display = "none";
	todos.style.opacity = "1";
});

//Edit Form Buttons Listeners

saveTodoEditButton.addEventListener("click",function(event){
	/*
	console.log("saved");
	console.log(todoEditNameText.value);
	console.log(todoEditDateText.value);
	console.log(selectedTodoId);
	*/
	let request = new XMLHttpRequest();
	request.addEventListener("load", todosEdited);
	request.open("get", "edit_todo.php?name="+todoEditNameText.value+"&date="+todoEditDateText.value+"&list_id="+list_id+"&todo_id="+selectedTodoId, true);
	request.send();
});

cancelTodoEditButton.addEventListener("click",function(event){
	editForm.style.display = "none";
	todos.style.opacity = "1";
});

function todoRemoved(){
	location.reload();
}

function todoUpdated(){
	console.log(this.responseText);
	let status = this.responseText;
	checkButton = selectedTodo.childNodes[7];
	
	if(status == "1"){
		selectedTodo.style.backgroundColor = "green";
		checkButton.innerHTML = "<i class='fa fa-check-square-o' aria-hidden='true'></i>";
	}
	else {
		selectedTodo.style.backgroundColor = "white";
		checkButton.innerHTML = "<i class='fa fa-square-o' aria-hidden='true'></i>";
	}
	//location.reload();
}

/**
	Reloads the location to show the new lists added
*/
function todosReceived(){
	todos.style.opacity = "1";
	location.reload();
}

function todosEdited(){
	todos.style.opacity = "1";
	location.reload();
}


/**
	Comments
*/
let addCommentButtons = document.querySelectorAll(".comments button, .no_comments button");

function addCommentButtonsListeners() {
	for(let i = 0; i < addCommentButtons.length; i++){
		addCommentButtons[i].addEventListener("click",function(){
			let todo_id_comment = this.parentNode.parentNode.id;
			let addCommentForm = document.querySelector("#\\3" + todo_id_comment + " > * #add_comment");
			if(addCommentForm.style.display === "block")
				addCommentForm.style.display = "none";
			else
				addCommentForm.style.display = "block";

			let submitCommentButton = document.querySelector("#\\3" + todo_id_comment + " > * #add_comment input[name='add_comment']");
			let cancelCommentButton = document.querySelector("#\\3" + todo_id_comment + " > * #add_comment input[name='cancel_comment']");
			
			submitCommentButton.addEventListener("click", function() {
				let inputTextComment = document.querySelector("#\\3" + todo_id_comment + " > * #add_comment input[name='comment']");
				console.log(inputTextComment);
				let request = new XMLHttpRequest();
				request.addEventListener("load", commentAction);
				request.open("get", "add_comment.php?todo_id="+todo_id_comment+"&text="+inputTextComment.value, true);
				request.send();
			});
			cancelCommentButton.addEventListener("click", function() {
				addCommentForm.style.display = "none";
			});
		});
	}
}
addCommentButtonsListeners();

function commentAction() {
	location.reload();
}
