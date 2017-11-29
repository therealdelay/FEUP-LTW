<?php 
	include_once('includes/init.php');
	include_once('database/list.php');
  
	$categories = getAllCategories();
	echo json_encode($categories);
?>