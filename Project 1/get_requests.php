<?php 

	include_once('includes/init.php');
	include_once('database/list.php');

	$requests = getRequests($_SESSION['username']);
	echo json_encode($requests);
?>