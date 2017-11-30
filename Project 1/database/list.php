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

	function addList($username, $title, $priority, $categories) {
		global $dbh;
		$stmt = $dbh->prepare("INSERT INTO lists (title, priority) VALUES (?, ?)");
		$stmt->execute(array($title, $priority));

		// CREATE TRIGGER FOR THIS?
		$stmt = $dbh->prepare("SELECT id FROM lists ORDER BY id DESC LIMIT 1");
		$stmt->execute();
		$list_id = $stmt->fetch()['id'];

		$stmt = $dbh->prepare("SELECT usr_id FROM users WHERE users.usr_username = ?");
		$stmt->execute(array($username));
		$usr_id = $stmt->fetch()['usr_id'];

		$stmt = $dbh->prepare("INSERT INTO belongs (list_id, usr_id) VALUES (?, ?)");
		$stmt->execute(array($list_id, $usr_id));

		//Add new categories or not
		$cat_ids = array();
		foreach($categories as $cat){
			$stmt = $dbh->prepare("SELECT cat_id FROM categories WHERE cat_name = ?");
			$stmt->execute(array($cat));
			$cat_id = $stmt->fetch()['cat_id'];

			if($cat_id == null){
				$stmt = $dbh->prepare("INSERT INTO categories (cat_name) VALUES (?)");
				$stmt->execute(array($cat));

				// IMPROVE THIS
				$stmt = $dbh->prepare("SELECT cat_id FROM categories ORDER BY cat_id DESC LIMIT 1");
				$stmt->execute();
				$cat_id = $stmt->fetch()['cat_id'];
			}
			$cat_ids[] = $cat_id;
		}

		foreach($cat_ids as $cat_id){
			$stmt = $dbh->prepare("INSERT INTO hasCategories (list_id, cat_id) VALUES (?, ?)");
			$stmt->execute(array($list_id, $cat_id));
		}
	}

	function addTodo($name, $date, $list_id){
		global $dbh;
		$stmt = $dbh->prepare("INSERT INTO todos (name, limit_date, list_id) VALUES (?, ?, ?)");
		$stmt->execute(array($name, $date, $list_id));

		$stmt = $dbh->prepare("SELECT todo_id FROM todos ORDER BY todo_id DESC LIMIT 1");
		$stmt->execute();
		$todo_id = $stmt->fetch()['todo_id'];

		$stmt = $dbh->prepare("INSERT INTO hasItems (list_id, todo_id) VALUES (?, ?)");
		$stmt->execute(array($list_id, $todo_id));
	}

	function getAllCategories() {
		global $dbh;
		$stmt = $dbh->prepare("SELECT cat_name FROM categories");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function removeTodo($todo_id, $list_id){
		global $dbh;
		$stmt = $dbh->prepare("DELETE FROM hasItems WHERE list_id = ? AND todo_id = ?");
		$stmt->execute(array($list_id, $todo_id));
		$stmt = $dbh->prepare("DELETE FROM todos WHERE todo_id = ?");
		$stmt->execute(array($todo_id));
	}

	function statusTodo($todo_id){
		global $dbh;
		$stmt = $dbh->prepare("UPDATE todos SET done = done*-1 WHERE todo_id = ?");
		$stmt->execute(array($todo_id));
		$stmt = $dbh->prepare("SELECT done FROM todos WHERE todo_id = ?");
		$stmt->execute(array($todo_id));
		return $stmt->fetch()['done'];
	}

	function editAllTodo($todo_id, $name, $date){
		global $dbh;
		$stmt = $dbh->prepare("UPDATE todos SET name = ?, limit_date = ? WHERE todo_id = ?");
		$stmt->execute(array($name, $date, $todo_id));

		$stmt = $dbh->prepare("SELECT name FROM todos WHERE todo_id = ?");
		$stmt->execute(array($todo_id));
		return $stmt->fetch()['name'];
	}

	function editDateTodo($todo_id, $date){
		global $dbh;
		$stmt = $dbh->prepare("UPDATE todos SET limit_date = ? WHERE todo_id = ?");
		$stmt->execute(array($date, $todo_id));
	}

	function editNameTodo($todo_id, $name){
		global $dbh;
		$stmt = $dbh->prepare("UPDATE todos SET name = ? WHERE todo_id = ?");
		$stmt->execute(array($name, $todo_id));
	}

?>