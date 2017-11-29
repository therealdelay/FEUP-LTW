<?php 

	include_once('includes/init.php');
	include_once('database/list.php');

	removeTodo($_GET['todo_id'], $_GET['list_id']); 
	echo $_GET['todo_id'];
?>