<?php

	function getAllLists($username){
		global $dbh;
		$stmt = $dbh->prepare("SELECT * FROM lists, users, belongs 
								WHERE lists.id = belongs.list_id AND belongs.usr_id = users.usr_id AND usr_username = ?");
		/* Talvez melhorar isto mais tarde*/
		$stmt->execute(array($username));
		return $stmt->fetchAll();
	}

	function getListTodos($list_id){
		global $dbh;
		$stmt = $dbh->prepare("SELECT * FROM todos, hasItems, lists
								WHERE lists.id = hasItems.list_id AND hasItems.todo_id = todos.todo_id AND lists.id = ?");
		$stmt->execute(array($list_id));
		return $stmt->fetchAll();
	}

?>