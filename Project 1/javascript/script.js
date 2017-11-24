let addButton = document.querySelector("img");
addButton.addEventListener("click", getForm);

let form = document.getElementById("add_form");
let lists = document.getElementById("lists");

function getForm(event){
	lists.style.display = "none";
	form.style.display = "block";
}


let addListButton = document.querySelector("input[value='Add']");
console.log(addListButton);
addListButton.addEventListener("click",function(event){
	let request = new XMLHttpRequest();
	//request.addEventListener("load", );
	request.open("get", ".php?name=" + text.value, true);
	request.send();
});