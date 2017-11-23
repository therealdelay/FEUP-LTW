<?php

  function isLoginCorrect($username, $password) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM users WHERE usr_username = ? AND usr_password = ?');
    $stmt->execute(array($username, sha1($password)));
    $cenas = $stmt->fetch();
    echo $cenas['usr_name'];
    return $cenas !== false;
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

  function editUser($old_username, $new_username, $name, $email, $image, $password){
    global $dbh;
    $stmt = $dbh->prepare('UPDATE users SET usr_name = ?, usr_email = ?, usr_image = ?, usr_password =? WHERE usr_username = ?');
    $stmt->execute(array($name, $email, $image, sha1($password), $old_username));
    $stmt = $dbh->prepare('UPDATE users SET usr_username = ? WHERE usr_username = ?');
    $stmt->execute(array($new_username, $old_username));
  }

?>