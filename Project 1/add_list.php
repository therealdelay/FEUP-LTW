<?php 
	include_once('includes/init.php');
	include_once('database/list.php');
  
	//addList($_SESSION['username'],$_POST['title'],$_POST['priority']);
	addList($_SESSION['username'],$_GET['title'],$_GET['priority']);
	
	echo $_GET['priority'];
?>