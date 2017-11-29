<?php
include_once('includes/init.php');
include_once('database/user.php');
  
	//setCurrentUser($_POST['username']);
	editUser($_SESSION['username'],$_POST['new_username'], $_POST['name'],$_POST['email'], $_POST['image'], $_POST['new_password']); 

	if (isLoginCorrect($_POST['new_username'], $_POST['new_password'])) { 
    	setCurrentUser($_POST['new_username']); 
  		header('Location: profile_page.php');
  	}
  	else
  		header('Location: index.php');
?>