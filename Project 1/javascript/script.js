let addButton = document.querySelector("img");
addButton.addEventListener("click", getForm);

let form = document.getElementById("add_form");
let lists = document.getElementById("lists");

function getForm(event){
	form.style.display = "inline";
	lists.style.opacity = "0.5";
}


let listTitleText = document.querySelector("#add_form input[name='title']");
let listPriorityText = document.querySelector("#add_form input[name='priority']");
let addListButton = document.querySelector("input[value='Add']");
let cancelListButton = document.querySelector("input[value='Cancel']");


addListButton.addEventListener("click",function(event){
	let request = new XMLHttpRequest();
	request.addEventListener("load", listsReceived);
	request.open("get", "add_list.php?title="+listTitleText.value+"&priority="+listPriorityText.value, true);
	request.send();
});


cancelListButton.addEventListener("click",function(event){
	form.style.display = "none";
	lists.style.opacity = "1";
});

function listsReceived(){
	console.log(this.responseText);
	lists.style.opacity = "1";
	location.reload();
}