<?php 

	include_once('includes/init.php');
	include_once('database/list.php');

	removeList($_GET['list_id'], $_SESSION['username']); 
?>