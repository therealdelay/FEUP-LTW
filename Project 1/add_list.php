<?php 
	include_once('includes/init.php');
	include_once('database/list.php');
  
	//addList($_SESSION['username'],$_POST['title'],$_POST['priority']);
	addList($_SESSION['username'],$_GET['title'],$_GET['priority'],$_GET['category']);
	
	echo $_GET['priority'];
?>