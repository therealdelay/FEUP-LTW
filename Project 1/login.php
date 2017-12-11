<?php
include_once('includes/init.php');
include_once('database/user.php');
	
	if (isLoginCorrect($_POST['username'], $_POST['password'])) {
      	setCurrentUser($_POST['username']);
      	echo $_SESSION['username'];
  		header('Location: home_page.php');
  		//header('Location: ' . $_SERVER['HTTP_REFERER']);
   	} else {
    	$_SESSION['error_messages'][] = "Login Failed!";
  		header('Location: index.php');
  	}
?>