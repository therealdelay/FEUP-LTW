<?php 
	include_once('includes/init.php');
	include_once('database/list.php');
	include_once('database/info.php');

	$lists = getAllLists($_SESSION['username']);

	$categories = array();
	foreach ($lists as $list) {
		$categories[$list['id']] = getListCategories($list['id']);
	}

	$todos = array();
	foreach ($lists as $list) {
		$todos[$list['id']] = getListTodos($list['id']);
	}


	$username = $_SESSION['username'];
	$name = getName($_SESSION['username'])['usr_name'];
	$email = getEMail($_SESSION['username'])['usr_email'];
	$image = getImage($_SESSION['username'])['usr_image'];

	include_once('templates/common/header_profile_page.php');
	include_once('templates/common/show_profile.php');
	include_once('templates/common/footer.php');
?>