<?php 
	include_once('includes/init.php');
	include_once('database/list.php');

	addComment($_SESSION['username'],$_GET['text'],$_GET['todo_id']);
?>