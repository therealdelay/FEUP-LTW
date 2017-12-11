<?php 

	include_once('includes/init.php');
	include_once('database/list.php');

	$date = $_GET['date'];
	$name = $_GET['name'];
	if(!empty($date) && !empty($name)){
		$lel = editAllTodo($_GET['todo_id'], $name, $date);
		echo $name;
		echo $date;
		echo $lel;
	}
	else if(!empty($date)/*$date !== null || $date !== ""*/){
		editDateTodo($_GET['todo_id'], $date);
	}
	else if(!empty($name)/*$name !== null || $name !== ""*/){
		editNameTodo($_GET['todo_id'], $name);
	}

?>