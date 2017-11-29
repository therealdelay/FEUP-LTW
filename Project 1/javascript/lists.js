let addButton = document.querySelector("img");
let form = document.getElementById("add_form");
let lists = document.getElementById("lists");
let select = document.querySelector("select");

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
let addCategoryButton = document.getElementById("add_category");
let addListButton = document.querySelector("input[value='Add']");
let cancelListButton = document.querySelector("input[value='Cancel']");

let addNewCategoryActivated = 0;
let maxNewCategory = 3;
let countNewCategory = 0;

/**
	Event that triggers when the user wants to add a new category. It adds a new input field
*/
addCategoryButton.addEventListener("click", function(event){
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
});

/**
	Event once the add button on the form is clicked. It add the new list to the database
*/
addListButton.addEventListener("click",function(event){
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

