<?php 

	include_once('includes/init.php');
	include_once('database/list.php');
  
	addList($_POST['title'],$_POST['priority']);
  	//header('Location: home_page.php');
?>