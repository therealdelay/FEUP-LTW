<?php
include_once('includes/init.php');
include_once('database/user.php');
  
	setCurrentUser($_POST['username']);//includes/session.php
		editUser($_POST['old_username'],$_POST['new_username'], $_POST['name'],$_POST['email'], $_POST['image'], $_POST['new_password']); 
  	header('Location: profile_page.php');
?>