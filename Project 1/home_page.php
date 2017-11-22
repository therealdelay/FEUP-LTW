<?php 
	include_once('includes/init.php');

	include_once('database/list.php');

	$lists = getAllLists($_SESSION['username']);
	$todos = array();
	foreach ($lists as $list) {
		$todos[$list['id']] = getListTodos($list['id']);
	}

	include_once('templates/common/header_landing_page.php');
	include_once('templates/todos/show_lists.php');
	include_once('templates/common/footer.php');
?>