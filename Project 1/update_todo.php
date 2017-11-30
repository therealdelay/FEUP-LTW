<?php 

	include_once('includes/init.php');
	include_once('database/list.php');

	$status = statusTodo($_GET['todo_id']);
	
	echo $status;
?>