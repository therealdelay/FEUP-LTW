<?php

  function isLoginCorrect($username, $password) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM users WHERE usr_username = ? AND usr_password = ?');
    $stmt->execute(array($username, sha1($password)));
    return $stmt->fetch() !== false;
  }

  function notExistUser($username){
  	global $dbh;
  	$stmt = $dbh->prepare('SELECT * FROM users WHERE usr_username = ?');
  	$stmt->execute(array($username));
  	return $stmt->fetch() === false;
  }

  function addUser($username, $name, $email, $image, $password){
    echo $username;
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO users (usr_username, usr_name, usr_email, usr_image, usr_password) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array($username, $name, $email, $image, sha1($password)));
  }

?>