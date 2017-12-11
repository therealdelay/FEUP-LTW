<?php 
	include_once('includes/init.php');
	include_once('database/list.php');
  
	$categories = getCategories($_GET['list_id']);
	echo json_encode($categories);
?>