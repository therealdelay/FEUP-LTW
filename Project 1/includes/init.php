<?php
  session_set_cookie_params(0, '/', 'www.fe.up.pt', true, true);
  include_once('includes/session.php'); //setCurrentUser
  include_once('database/connection.php');//get database
?>