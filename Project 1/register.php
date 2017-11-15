<?php
include_once('includes/init.php');
include_once('database/user.php');
  
	if(notExistUser($_POST['username'])){//database/user.php
		setCurrentUser($_POST['username']);//includes/session.php
		if(isset($_POST['username']) && isset($_POST['password'])){
			addUser($_POST['username'], $_POST['name'],$_POST['email'], $_POST['image'], $_POST['password']); //database/user.php
		}
	}
  	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>