<?php
include_once('includes/init.php');
include_once('database/user.php');
  	
  	if(preg_match('/.{3,}/', $_POST['username']) != 1){
		$_SESSION['error_messages'][] = "Register Failed!";
  		header('Location: home_page.php');
  	}

  	if(preg_match('/[A-Z][a-z]*([\s][A-Z][a-z]*)*/', $_POST['name']) != 1){
		$_SESSION['error_messages'][] = "Register Failed!";
  		header('Location: home_page.php');
  	}

  	if(preg_match('/[^@]*@[^@]*[\.].*/', $_POST['email']) != 1){
  		$_SESSION['error_messages'][] = "Register Failed!";
  		header('Location: home_page.php');
  	}

  	$chars = preg_quote('-_?!@#+*$%&/()=', '/');
	if(preg_match('/[$chars]*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}/', $_POST['password']) != 1){
  		$_SESSION['error_messages'][] = "Register Failed!";
  		header('Location: home_page.php');
  	}

	if(notExistUser($_POST['username'])){
		setCurrentUser($_POST['username']);
		addUser($_POST['username'], $_POST['name'],$_POST['email'], $_POST['image'], $_POST['password']);
		$_SESSION['success_messages'][] = "Register Succeeded!";
  		header('Location: home_page.php');
	}
	else{
		$_SESSION['error_messages'][] = "Register Failed!";
		header('Location: index.php');
	}
?>