<?php 
	include_once('includes/init.php');

	include_once('database/list.php');

	$todos = array();
	$todos = getListTodos($_GET['id']);


	include_once('templates/common/header.php');
	include_once('templates/todos/show_todos.php');
	include_once('templates/common/footer.php');
?>