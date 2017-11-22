<?php

	function getAllTodos($username){
		global $dbh;
		$stmt = $dbh->prepare("SELECT * FROM todos, users WHERE todos.usr_id = users.usr_id AND usr_username = ?");
		/* Talvez melhorar isto mais tarde*/
		/* Nem sei se funciona*/
		$stmt->execute(array($username));
		return $stmt->fetchAll();
	}

?>