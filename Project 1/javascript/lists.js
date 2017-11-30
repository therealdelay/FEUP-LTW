let addButton = document.querySelector("img");
let form = document.getElementById("add_form");
let lists = document.getElementById("lists");
let select = document.querySelector("select");

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
	form.style.display = "inline";
	lists.style.opacity = "0.5";

	let request = new XMLHttpRequest();
	request.addEventListener("load", getCategories);
	request.open("get", "get_categories.php", true);
	request.send();
}

function getEditForm(){
	editForm.style.display = "inline";
	lists.style.opacity = "0.5";
	
	let request = new XMLHttpRequest();
	request.addEventListener("load", getCategories);
	request.open("get", "get_categories.php", true);
	request.send();
}

let listTitleText = document.querySelector("#add_form input[name='title']");
let listPriorityText = document.querySelector("#add_form input[name='priority']");
let addCategoryButton = document.getElementById("add_category");
let addListButton = document.querySelector("input[value='Add']");
let cancelListButton = document.querySelector("input[value='Cancel']");


// Edit Form Selector
let editForm = document.getElementById("edit_form");

// Edit Todo Form Selectors
let listEditNameText = document.querySelector("#edit_form  input[name='title']");
let listEditPriority = document.querySelector("#edit_form input[name='priority']");
let listEditCategories = document.querySelector("#edit_form #categories");

// Edit Form Button Selectors
let addEditCategoryButton = document.querySelector("#edit_form #add_category");
let saveListEditButton = document.querySelector("#edit_form input[value='Add']");
let cancelListEditButton = document.querySelector("#edit_form input[value='Cancel']");

// List Buttons Selectors
let listEditButtons = document.querySelectorAll(".list button[name='Edit']");
let listRemoveButtons = document.querySelectorAll(".list button[name='Remove']");

let addNewCategoryActivated = 0;
let maxNewCategory = 3;
let countNewCategory = 0;

function addRemoveButtonsListeners(){
	for(let i = 0; i < listRemoveButtons.length; i++){
		listRemoveButtons[i].addEventListener("click",function(event){
			event.preventDefault();
			/*
			let request = new XMLHttpRequest();
			request.addEventListener("load", todoRemoved);
			request.open("get", "remove_todo.php?list_id="+list_id+"&todo_id="+this.parentNode.parentNode.id, true);
			request.send();
			*/
			//this.parentNode.parentNode.remove();
		});
	}
}

function addEditButtonsListeners(){
	for(let i = 0; i < listEditButtons.length; i++){
		listEditButtons[i].addEventListener("click",function(event){
			event.preventDefault();
			//selectedListId = this.parentNode.parentNode.id;
			listEditNameText.value = this.parentNode.childNodes[1].innerHTML;
			let priorityString = this.parentNode.classList[this.parentNode.classList.length-1];
			listEditPriority.value = priorities[priorityString];
			getEditForm();
		});
	}
}

addRemoveButtonsListeners();
addEditButtonsListeners();

function addCategoryHandler(event){
	if(countNewCategory < maxNewCategory){
		addNewCategoryActivated = 1;
		let divNewCategories = document.getElementById("new_categories");
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

	if(addNewCategoryActivated === 0){
		console.log("add_list.php?title="+listTitleText.value+"&priority="+listPriorityText.value+"&"+getSelectedOptions().join('&'));
		request.open("get", "add_list.php?title="+listTitleText.value+"&priority="+listPriorityText.value+"&"+getSelectedOptions().join('&'), true);
		request.send();
	}
	else {
		let oldCategories = getSelectedOptions();
		let inputCategories = document.querySelectorAll("input[name='category']");
		for(let i = 0; i < inputCategories.length; i++){
			if(inputCategories[i].value !== ""){
				oldCategories.push("category[]="+inputCategories[i].value);
			}
		}
		request.open("get", "add_list.php?title="+listTitleText.value+"&priority="+listPriorityText.value+"&"+oldCategories.join('&'), true);
		request.send();
	}
}

/**
	Event that triggers when the user wants to add a new category. It adds a new input field
*/
addCategoryButton.addEventListener("click", addCategoryHandler);

addEditCategoryButton.addEventListener("click", addCategoryHandler);

/**
	Event once the add button on the form is clicked. It add the new list to the database
*/
addListButton.addEventListener("click", saveListHandler);

saveListEditButton.addEventListener("click",saveListHandler);


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

/**
	Gets all the categories from the database
*/
function getCategories() {
	let categories = JSON.parse(this.responseText);
	select.innerHTML = ""; 

	for (cat in categories) {
		let item = document.createElement("option");
		item.value = cat;
		item.innerHTML = categories[cat]['cat_name'];
		select.appendChild(item);
	}
}
/**
	Returns the selected options in the categories dropdown
*/
function getSelectedOptions() {
    var result = [];
	var options = document.querySelectorAll("option");
  	for (let a = 0; a < options.length; a++) {
	    if (options[a].selected === true) {
       		result.push("category[]=" + options[a].text);
	    }
  	}
  	return result;
}