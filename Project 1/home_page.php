<?php 
	include_once('includes/init.php');

	include_once('database/todo.php');

	$todos = getAllTodos($_SESSION['username']);

	include_once('templates/common/header_landing_page.php');
	include_once('templates/todos/show_todos.php');
	include_once('templates/common/footer.php');
?>