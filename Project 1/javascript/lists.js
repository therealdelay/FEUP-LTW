let addButton = document.querySelector("#ultimo a");
let form = document.getElementById("add_form");
let lists = document.getElementById("lists");

let selectedListId = null;

let priorities = {"p1":1, "p2":2, "p3":3};

/**
	Event to get the form once the add list button is clicked
*/
addButton.addEventListener("click", getForm);
/**
	Gets the form to add a list and gets all the categories from the database
*/
function getForm(event){
	event.preventDefault();
	form.style.display = "inline";
	lists.style.opacity = "0.5";
}


let listTitleText = document.querySelector("#add_form input[name='title']");
let listPriorityText = document.querySelector("#add_form select");
let addCategoryButton = document.getElementById("add_category");
let addListButton = document.querySelector("input[value='Add']");
let cancelListButton = document.querySelector("input[value='Cancel']");


// Edit Form Selector
let editForm = document.getElementById("edit_form");

// Edit Todo Form Selectors
let listEditNameText = document.querySelector("#edit_form  input[name='title']");
let listEditPriority = document.querySelector("#edit_form select");
let listEditCategories = document.querySelector("#edit_form #categories");

// Edit Form Button Selectors
let addEditCategoryButton = document.querySelector("#edit_form #add_category");
let saveListEditButton = document.querySelector("#edit_form input[value='Save']");
let cancelListEditButton = document.querySelector("#edit_form input[value='Cancel']");

// List Buttons Selectors
let listEditButtons = document.querySelectorAll(".list button[name='Edit']");
let listRemoveButtons = document.querySelectorAll(".list button[name='Remove']");

let maxNewCategory = 3;
let countNewCategory = 0;

function addRemoveButtonsListeners(){
	for(let i = 0; i < listRemoveButtons.length; i++){
		listRemoveButtons[i].addEventListener("click",function(event){
			event.preventDefault();
			let request = new XMLHttpRequest();
			request.addEventListener("load", listRemoved);
			request.open("get", "remove_list.php?list_id="+this.parentNode.id, true);
			request.send();
			
		});			//this.parentNode.parentNode.remove();

	}
}

function addEditButtonsListeners(){
	for(let i = 0; i < listEditButtons.length; i++){
		listEditButtons[i].addEventListener("click",function(event){
			event.preventDefault();
			let request = new XMLHttpRequest();
			request.addEventListener("load", getCategories);

			selectedListId = this.parentNode.id;
			listEditNameText.value = this.parentNode.childNodes[1].innerHTML;
			let priorityString = this.parentNode.classList[this.parentNode.classList.length-1];
			listEditPriority.value = priorities[priorityString];
			editForm.style.display = "inline";
			lists.style.opacity = "0.5";
			
			request.open("get", "get_categories.php?list_id="+this.parentNode.id, true);
			request.send();
		});
	}
}

addRemoveButtonsListeners();
addEditButtonsListeners();

function addCategoryHandler(event){
	if(countNewCategory < maxNewCategory){
		let divNewCategories = document.querySelector("#add_form #new_categories");
		let newInput = document.createElement("input");
		newInput.setAttribute("type", "text");
		newInput.setAttribute("placeholder", "new category");
		newInput.setAttribute("name", "category");
		divNewCategories.appendChild(newInput);
		countNewCategory++;
	}
}

function addEditCategoryHandler(event){
	if(countNewCategory < maxNewCategory){
		let divNewCategories = document.querySelector("#edit_form #new_categories");
		let newInput = document.createElement("input");
		newInput.setAttribute("type", "text");
		newInput.setAttribute("placeholder", "new category");
		newInput.setAttribute("name", "category");
		divNewCategories.appendChild(newInput);
		countNewCategory++;
	}
}


function saveListHandler(event){
	let request = new XMLHttpRequest();
	request.addEventListener("load", listsReceived);

	let newCategories = new Array();
	let inputCategories = document.querySelectorAll("input[name='category']");
	for(let i = 0; i < inputCategories.length; i++){
		if(inputCategories[i].value !== ""){
			newCategories.push("category[]="+inputCategories[i].value);
		}
	}
	request.open("get", "add_list.php?title="+listTitleText.value+"&priority="+listPriorityText.value+"&"+newCategories.join('&'), true);
	request.send();
}

/**
	Event that triggers when the user wants to add a new category. It adds a new input field
*/
addCategoryButton.addEventListener("click", addCategoryHandler);

addEditCategoryButton.addEventListener("click", addEditCategoryHandler);

/**
	Event once the add button on the form is clicked. It add the new list to the database
*/
addListButton.addEventListener("click", saveListHandler);

saveListEditButton.addEventListener("click",function(event){
	let request = new XMLHttpRequest();
	request.addEventListener("load", listsReceived);

	let newCategories = new Array();
	let inputCategories = document.querySelectorAll("#edit_form input[name='category']");
	for(let i = 0; i < inputCategories.length; i++){
		if(inputCategories[i].value !== ""){
			newCategories.push("category[]="+inputCategories[i].value);
		}
	}
	request.open("get", "edit_list.php?list_id=" + selectedListId + "&title="+listEditNameText.value+"&priority="+listEditPriority.value+"&"+newCategories.join('&'), true);
	request.send();
});


cancelListEditButton.addEventListener("click",function(event){
	editForm.style.display = "none";
	lists.style.opacity = "1";
});
/**
	Once the cancel button is clicked, it will go back to the list view
*/
cancelListButton.addEventListener("click",function(event){
	form.style.display = "none";
	lists.style.opacity = "1";
});

/**
	Reloads the location to show the new lists added
*/
function listsReceived(){
	lists.style.opacity = "1";
	location.reload();
}

function listRemoved() {
	location.reload();
}

/**
	Gets all the categories from the database
*/

function getCategories() {
	let categories = JSON.parse(this.responseText);
	let divNewCategories = document.querySelector("#edit_form #new_categories");
	divNewCategories.innerHTML = "";
	
	for (cat in categories) {
		let newInput = document.createElement("input");
		newInput.setAttribute("type", "text");
		newInput.setAttribute("placeholder", "new category");
		newInput.setAttribute("name", "category");
		newInput.value = categories[cat]['cat_name'];
		divNewCategories.appendChild(newInput);
		console.log(newInput);
		console.log(divNewCategories);
	}
}
