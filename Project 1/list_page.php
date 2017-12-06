<?php 
	include_once('includes/init.php');
	include_once('database/list.php');

	$todos = array();
	$todos = getListTodos($_GET['list_id']);
	foreach($todos as $todo){
		print_r($todo);
	}
	include_once('templates/common/header_todos_list.php');
	include_once('templates/todos/show_todos.php');
	include_once('templates/common/footer.php');
?>