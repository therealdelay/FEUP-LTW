<?php 
	include_once('includes/init.php');
	include_once('database/list.php');

	inviteUser($_SESSION['username'],$_GET['list_id'],$_GET['username']);
?>