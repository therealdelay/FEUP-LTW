let deleteAccountButton = document.getElementById("delete_profile");
let verificationForm = document.getElementById("verification");
let profile = document.getElementById("profile");

deleteAccountButton.addEventListener("click", function(event){
	verificationForm.style.display = "block";
	profile.style.opacity = "0.5";
});

let submitDelete = document.querySelector("#verification input[type='submit']");
submitDelete.addEventListener("click", function(){
	let passwordInput = document.querySelector("#verification input[type='password']");
	let request = new XMLHttpRequest();
	request.addEventListener("load", deleteUser);
	request.open("post", "delete_user.php", true);
	request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	request.send(encodeForAjax({password: passwordInput.value}));
});

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function deleteUser() {
	console.log(this.responseText);
	window.location.replace(this.responseText);
}