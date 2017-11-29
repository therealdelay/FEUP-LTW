<?php 

	include_once('includes/init.php');
	include_once('database/list.php');

	addTodo($_GET['name'], $_GET['date'],$_GET['list_id']); 
?>