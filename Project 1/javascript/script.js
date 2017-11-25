let addButton = document.querySelector("img");
addButton.addEventListener("click", getForm);

let form = document.getElementById("add_form");
let lists = document.getElementById("lists");

function getForm(event){
	lists.style.display = "none";
	form.style.display = "block";
}


let addListButton = document.querySelector("input[value='Add']");

addListButton.addEventListener("click",function(event){
	let request = new XMLHttpRequest();
	request.addEventListener("load", listsReceived);
	request.open("get", "show_lists.php", true);
	request.send();
	
});

function listsReceived(){
	console.log(this.responseText);
	lists.innerHTML = this.responseText;
}