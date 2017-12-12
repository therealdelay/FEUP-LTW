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


/**
	NOTIFICATIONS
*/

let notifications = new Array();

function checkNotifications() {
	let request = new XMLHttpRequest();
	request.addEventListener("load", updateNotifications);
	request.open("get", "get_requests.php", true);
	request.send();
}

function updateNotifications() {
	notifications = (JSON.parse(this.responseText)).slice();
	if(notifications.length > 0){
		let notificationDiv = document.querySelector("#notifications");
		let notificationBox = document.querySelector("#notifications_box ul");
		for(let i = 0; i < notifications.length; i++){
			let li = document.createElement('li');
			li.innerHTML = "You were invited to the list <strong>"+ notifications[i].title+"</strong> by user <em>"+notifications[i].usr_username+"</em>";
			let buttonAccept = document.createElement('button');
			buttonAccept.setAttribute("class", "accept");
			buttonAccept.innerHTML = "<i class='fa fa-check' aria-hidden='true'></i>";
			let buttonDecline = document.createElement('button');
			buttonDecline.setAttribute("class", "decline");
			buttonDecline.innerHTML = "<i class='fa fa-times' aria-hidden='true'></i>";
			li.appendChild(buttonAccept);
			li.appendChild(buttonDecline);
			notificationBox.appendChild(li);
		}		
		notificationDiv.style.display = "block";
		inviteButtonsListener();
	}
}
checkNotifications();

function inviteButtonsListener() {
	let acceptInviteButtons = document.querySelectorAll(".accept");
	let declineInviteButtons = document.querySelectorAll(".decline");
	for(let i = 0; i < acceptInviteButtons.length; i++){
		acceptInviteButtons[i].addEventListener("click", function(event) {
			let request = new XMLHttpRequest();
			request.addEventListener("load", deleteRequest);
			request.open("get", "add_user_to_list.php?list_title="+notifications[i].title + "&owner_usr_username="+notifications[i].usr_username, true);
			request.send();
		});
	}

	for(let j = 0; j < declineInviteButtons.length; j++){
		declineInviteButtons[j].addEventListener("click", function(event) {
			let request = new XMLHttpRequest();
			request.addEventListener("load", deleteRequest);
			request.open("get", "remove_request.php?list_title="+notifications[j].title + "&owner_usr_username="+notifications[j].usr_username, true);
			request.send();
		});
	}
}

function deleteRequest() {
	location.reload();
}

/**
	ADD AND REMOVE
*/


let listTitleText = document.querySelector("#add_form input[name='title']");
let listPriorityText = document.querySelector("#add_form select");
let addCategoryButton = document.getElementById("add_category_add_form");
let addListButton = document.querySelector("input[value='Add']");
let cancelListButton = document.querySelector("input[value='Cancel']");


// Edit Form Selector
let editForm = document.getElementById("edit_form");

// Edit Todo Form Selectors
let listEditNameText = document.querySelector("#edit_form  input[name='title']");
let listEditPriority = document.querySelector("#edit_form select");
let listEditCategories = document.querySelector("#edit_form #categories");

// Edit Form Button Selectors
let addEditCategoryButton = document.querySelector("#edit_form #add_category_edit_form");
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
			event.cancelBubble = true;
   			if(event.stopPropagation) event.stopPropagation();

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
			event.cancelBubble = true;
   			if(event.stopPropagation) event.stopPropagation();

			let request = new XMLHttpRequest();
			request.addEventListener("load", getCategories);

			selectedListId = this.parentNode.id;
			listEditNameText.value = this.parentNode.childNodes[1].innerHTML;
			let priorityString = this.parentNode.classList[this.parentNode.classList.length-2];
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
		let divNewCategories = document.querySelector("#add_form .new_categories");
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
		let divNewCategories = document.querySelector("#edit_form .new_categories");
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
	let divNewCategories = document.querySelector("#edit_form .new_categories");
	divNewCategories.innerHTML = "";
	
	for (cat in categories) {
		let newInput = document.createElement("input");
		newInput.setAttribute("type", "text");
		newInput.setAttribute("placeholder", "new category");
		newInput.setAttribute("name", "category");
		newInput.value = categories[cat]['cat_name'];
		divNewCategories.appendChild(newInput);
	}
}


/**
	Invite new users to the list
*/
let inviteUserButtons = document.querySelectorAll(".list button[name='Invite']");
let inviteUserForm = document.getElementById("invite_user_form");
let addNewUserButton = document.querySelector("#invite_user_form input[value='Add']");
let cancelNewUserButton = document.querySelector("#invite_user_form input[value='Cancel']");

function addInviteUserButtonsListener(){
	for(let i = 0; i < inviteUserButtons.length; i++){
		inviteUserButtons[i].addEventListener("click", function(event){
			event.cancelBubble = true;
   			if(event.stopPropagation) event.stopPropagation();
   			
			selectedListId = this.parentNode.id;
			inviteUserForm.style.display = "inline";
			lists.style.opacity = "0.5";
		});
	}
}

addInviteUserButtonsListener();

addNewUserButton.addEventListener("click", function(event){
	let request = new XMLHttpRequest();
	request.addEventListener("load", userReceived);

	let inputUsername = document.querySelector("#invite_user_form input[name='username']");
	
	request.open("get", "invite_user_list.php?list_id="+selectedListId+"&username="+inputUsername.value, true);
	request.send();
});

cancelNewUserButton.addEventListener("click", function(event){
	inviteUserForm.style.display = "none";
	lists.style.opacity = "1";
});

function userReceived() {
	lists.style.opacity = "1";
	location.reload();
}