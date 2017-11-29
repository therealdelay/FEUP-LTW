<?php 
	include_once('includes/init.php');
	include_once('database/info.php');

	$old_username = $_SESSION['username'];
	$new_username = $_SESSION['username'];
	$name = getName($_SESSION['username'])['usr_name'];
	$email = getEMail($_SESSION['username'])['usr_email'];
	$image = getImage($_SESSION['username'])['usr_image'];
	$password = getPassword($_SESSION['username'])['usr_password'];

	include_once('templates/user/edit_form.php');
?>