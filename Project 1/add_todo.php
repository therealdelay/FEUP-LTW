<?php 

	include_once('includes/init.php');
	include_once('database/list.php');
  
	addTodo($_POST['name'], $_POST['date'],$_POST['priority'],$_GET['id']); //how to get the list id
  	header('Location: home_page.php');

?>