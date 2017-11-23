let addButton = document.querySelector("img");
addButton.addEventListener("click", getForm);

let form = document.getElementById("add_form");
let lists = document.getElementById("lists");

function getForm(event){
	lists.style.display = "none";
	form.style.display = "block";
}