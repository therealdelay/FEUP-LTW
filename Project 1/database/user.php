<?php

  function isLoginCorrect($username, $password) {
      global $dbh;

      $usrnm = strtolower($username);
      $stmt = $dbh->prepare('SELECT * FROM users WHERE usr_username = ?');
      $stmt->execute(array($usrnm));
      $user = $stmt->fetch();
      if(password_verify($password, $user['usr_password'])) {
        return true;
      } else {
        return false;
      }
  }

  function notExistUser($username){
  	global $dbh;
    $usrnm = strtolower($username);
  	$stmt = $dbh->prepare('SELECT * FROM users WHERE usr_username = ?');
  	$stmt->execute(array($usrnm));
  	return $stmt->fetch() === false;
  }

  function addUser($username, $name, $email, $image, $password){
    global $dbh;
    $options = ['cost' => 12];
    $usrnm = strtolower($username);
    $stmt = $dbh->prepare('INSERT INTO users (usr_username, usr_name, usr_email, usr_image, usr_password) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array($usrnm, $name, $email, $image, password_hash($password, PASSWORD_DEFAULT, $options)));
  }

  function editUser($old_username, $new_username, $name, $email, $image, $password){
    global $dbh;
    $usrnm = strtolower($new_username);
    $options = ['cost' => 12];
    if((($usrnm != $old_username) && notExistUser($usrnm)) || ($usrnm == $old_username)){
      $stmt = $dbh->prepare('UPDATE users SET usr_username = ?, usr_name = ?, usr_email = ?, usr_image = ?, usr_password =? WHERE usr_username = ?');
      $stmt->execute(array($usrnm, $name, $email, $image, password_hash($password, PASSWORD_DEFAULT, $options), $old_username));
    }
    else{
      return false;
    }
    return true;
  }

  function deleteUser($username){
    global $dbh;
    $stmt = $dbh->prepare("DELETE FROM users WHERE usr_username = ?");
    $stmt->execute(array($username));

  }
?>