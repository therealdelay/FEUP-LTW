<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>To Do</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,800" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/landing_page.css">
</head>
<body>
	<header>
		<?php if (isset($_SESSION['username']) && $_SESSION['username'] != '') { ?>
			<a href="home_page.php"><i class="fa fa-list fa-2x" aria-hidden="true"></i></a>
		<?php } else { ?>
			<i class="fa fa-list fa-2x" aria-hidden="true"></i>
		<?php } ?>
		<h1>To Do</h1>
		<?php include_once('templates/common/user.php'); ?>
	</header>
	<div id="messages">
      <?php $errors = getErrorMessages();foreach ($errors as $error) { ?>
      <div class="error">
        <p><?=$error?></p>
      </div>
      <?php } ?>
      <?php $successes = getSuccessMessages();foreach ($successes as $success) { ?>
      <div class="success">
        <p><?=$success?></p>
      </div>
      <?php } clearMessages(); ?>
    </div>