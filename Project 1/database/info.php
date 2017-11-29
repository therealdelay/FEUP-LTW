<?php

	function getName($username){
		global $dbh;
		$stmt = $dbh->prepare("SELECT usr_name FROM users
								WHERE usr_username = ?;");
		$stmt->execute(array($username));
		return $stmt->fetch();
	}

	function getEMail($username){
		global $dbh;
		$stmt = $dbh->prepare("SELECT usr_email FROM users
								WHERE usr_username = ?;");
		$stmt->execute(array($username));
		return $stmt->fetch();
	}	

	function getImage($username){
		global $dbh;
		$stmt = $dbh->prepare("SELECT usr_image FROM users
								WHERE usr_username = ?;");
		$stmt->execute(array($username));
		return $stmt->fetch();
	}	

	function getPassword($username){
		global $dbh;
		$stmt = $dbh->prepare("SELECT usr_password FROM users
								WHERE usr_username = ?;");
		$stmt->execute(array($username));
		return $stmt->fetch();
	}	
?>