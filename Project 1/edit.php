<?php
include_once('includes/init.php');
include_once('database/user.php');

if(preg_match('/.{3,}/', $_POST['new_username']) != 1){
  $_SESSION['error_messages'][] = "Edition Failed!";
  header('Location: profile_page.php');
}

if(preg_match('/[A-Z][a-z]*([\s][A-Z][a-z]*)*/', $_POST['name']) != 1){
  $_SESSION['error_messages'][] = "Edition Failed!";
  header('Location: profile_page.php');
}

if(preg_match('/[^@]*@[^@]*[\.].*/', $_POST['email']) != 1){
  $_SESSION['error_messages'][] = "Edition Failed!";
  header('Location: profile_page.php');
}

$chars = preg_quote('-_?!@#+*$%&/()=', '/');
if(preg_match('/[$chars]*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}/', $_POST['new_password']) != 1){
  $_SESSION['error_messages'][] = "Edition Failed!";
  header('Location: profile_page.php');
}

if(!editUser($_SESSION['username'],$_POST['new_username'], $_POST['name'],$_POST['email'], $_POST['image'], $_POST['new_password'])){
  $_SESSION['error_messages'][] = "Edition Failed!";
  header('Location: profile_page.php');
}
else{
  if (isLoginCorrect($_POST['new_username'], $_POST['new_password'])) { 
    setCurrentUser($_POST['new_username']); 
    $_SESSION['success_messages'][] = "Edition Succeeded!";
    header('Location: profile_page.php');
  }
  else
   header('Location: index.php');
}
?>