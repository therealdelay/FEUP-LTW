<?php
	include_once('includes/session.php');
	include_once('database/connection.php');

	include_once('database/list.php');
	
	include_once('templates/todos/time.php');

	echo $_SESSION['username'];
	if (!isset($_SESSION['username'])){
     	//header('Location: page404.php');
	}
    else{
		$lists = getAllLists($_SESSION['username']);

		$categories = array();
		foreach ($lists as $list) {
			$categories[$list['id']] = getListCategories($list['id']);
		}

		$todos = array();
		foreach ($lists as $list) {
			$todos[$list['id']] = getListTodos($list['id']);
		}

		include_once('templates/common/header.php');
		include_once('templates/todos/show_lists.php');
		include_once('templates/common/footer.php');
	}
?>