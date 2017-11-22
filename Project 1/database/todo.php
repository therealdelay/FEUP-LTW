<?php

	function getAllTodos(){
		global $dbh;
		$stmt = $dbh->prepare('SELECT * FROM todo JOIN category USING(cat_id)');
		/* Talvez melhorar isto mais tarde*/
		/* Nem sei se funciona*/
		$stmt->execute();
		return $stmt->fetchAll();
	}

?>