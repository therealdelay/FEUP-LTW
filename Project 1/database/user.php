<?php

  function isLoginCorrect($username, $password) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM user WHERE usr_username = ? AND usr_password = ?');
    $stmt->execute(array($username, sha1($password)));
    return $stmt->fetch() !== false;
  }

  function notExistUser($username){
  	global $dbh;
  	$stmt = $dbh->prepare('SELECT * FROM user WHERE usr_username = ?');
  	$stmt->execute($username);
  	return $stmt->fetch() === false;
  }

  function addUser($username, $name, $email, $image, $password){
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO user (usr_username, usr_name, usr_email, usr_image, usr_password) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array($username, $name, $email, $image, $password));
  }

?>