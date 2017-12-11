<?php 
	include_once('includes/init.php');
	include_once('database/list.php');

	removeRequestWithNames($_SESSION['username'],$_GET['list_title'], $_GET['owner_usr_username']);
?>