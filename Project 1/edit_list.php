<?php 
	include_once('includes/init.php');
	include_once('database/list.php');
  

	editList($_GET['list_id'], $_GET['title'],$_GET['priority'],$_GET['category']);
	
?>