<?php 
	include_once('includes/init.php');
	include_once('database/list.php');

	$todos = array();
	$todos = getListTodos($_GET['list_id']);
	$comments = array();
	foreach ($todos as $todo) {
		$comments[$todo['todo_id']] = getTodoComments($todo['todo_id']);
	}

	include_once('templates/common/header_todos_list.php');
	include_once('templates/todos/show_todos.php');
	include_once('templates/common/footer.php');
?>