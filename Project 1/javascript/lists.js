let addButton = document.querySelector("img");
let form = document.getElementById("add_form");
let lists = document.getElementById("lists");

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

let listTitleText = document.querySelector("#add_form input[name='title']");
let listPriorityText = document.querySelector("#add_form input[name='priority']");
let addListButton = document.querySelector("input[value='Add']");
let cancelListButton = document.querySelector("input[value='Cancel']");

/**
	Event once the add button on the form is clicked. It add the new list to the database
*/
addListButton.addEventListener("click",function(event){
	let request = new XMLHttpRequest();
	request.addEventListener("load", listsReceived);
	request.open("get", "add_list.php?title="+listTitleText.value+"&priority="+listPriorityText.value+"&category="+getSelectedOption(), true);
	request.send();
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
	console.log(this.responseText);
	lists.style.opacity = "1";
	location.reload();
}

/**
	Gets all the categories from the database
*/
function getCategories() {
	let categories = JSON.parse(this.responseText);
	let list = document.querySelector("select");
	list.innerHTML = ""; 

	for (cat in categories) {
		let item = document.createElement("option");
		item.value = cat;
		item.innerHTML = categories[cat]['cat_name'];
		list.appendChild(item);
	}
}
/**
	Returns the select option in the categories dropdown
*/
function getSelectedOption() {
	var select = document.getElementById("categories");
	if (select.selectedIndex == -1)
        return null;
    return select.options[select.selectedIndex].text;
}

