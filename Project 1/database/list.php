<?php

	function getAllLists($username){
		global $dbh;
		$stmt = $dbh->prepare("SELECT * FROM lists, users, belongs
								WHERE lists.id = belongs.list_id AND belongs.usr_id = users.usr_id AND usr_username = ?;");
		/* Talvez melhorar isto mais tarde*/
		$stmt->execute(array($username));
		return $stmt->fetchAll();
	}

	function getListCategories($list_id){
		global $dbh;
		$stmt = $dbh->prepare("SELECT * FROM lists, hasCategories, categories
								WHERE hasCategories.list_id = lists.id AND hasCategories.cat_id = categories.cat_id AND lists.id = ?");
		$stmt->execute(array($list_id));
		return $stmt->fetchAll();
	}

	function getListTodos($list_id){
		global $dbh;
		$stmt = $dbh->prepare("SELECT * FROM todos, hasItems, lists
								WHERE lists.id = hasItems.list_id AND hasItems.todo_id = todos.todo_id AND lists.id = ?");
		$stmt->execute(array($list_id));
		return $stmt->fetchAll();
	}

	function addList($username, $title, $priority) {
		global $dbh;
		$stmt = $dbh->prepare("INSERT INTO lists (title, priority) VALUES (?, ?)");
		$stmt->execute(array($title, $priority));

		// CREATE TRIGGER FOR THIS?
		$stmt = $dbh->prepare("SELECT id FROM lists WHERE lists.title = ?");
		$stmt->execute(array($title));
		$list_id = $stmt->fetch()['id'];

		$stmt = $dbh->prepare("SELECT usr_id FROM users WHERE users.usr_username = ?");
		$stmt->execute(array($username));
		$usr_id = $stmt->fetch()['usr_id'];

		$stmt = $dbh->prepare("INSERT INTO belongs (list_id, usr_id) VALUES (?, ?)");
		$stmt->execute(array($list_id, $usr_id));
	}

	function addTodo($name, $date, $priority, $list_id){
		global $dbh;
	}

?>