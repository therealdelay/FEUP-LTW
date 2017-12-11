<?php 
	include_once('includes/init.php');
	include_once('database/user.php');

	//echo $_POST['password'];
	if (isLoginCorrect($_SESSION['username'], $_POST['password'])) {
		deleteUser($_SESSION['username']);
		session_destroy();
		echo "index.php";
	}
	else {
		echo "profile_page.php";
		//header('Location: profile_page.php');
	}
?>