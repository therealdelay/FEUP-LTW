<?php
include_once('includes/init.php');
include_once('database/user.php');
	
	if (isLoginCorrect($_POST['username'], $_POST['password'])) {
      	setCurrentUser($_POST['username']);
  		header('Location: home_page.php');
   	} else {
    	$_SESSION['error_messages'][] = "Login Failed!";
  		header('Location: index.php');
  	}
?>