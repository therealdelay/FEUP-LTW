<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>To Do</title>
	<script src="javascript/lists.js" async></script>
	<script src="javascript/search.js" async></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,800" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/todos.css">
</head>
<body>
	<header>
		<a href="home_page.php"><i class="fa fa-list fa-2x" aria-hidden="true"></i></a>
		<h1>To Do</h1>
		<?php include_once('templates/common/user.php'); ?>
	</header>
	<section id="messages">
      <?php $errors = getErrorMessages();foreach ($errors as $error) { ?>
      <article class="error">
        <p><?=$error?></p>
      </article>
      <?php } ?>
      <?php $successes = getSuccessMessages();foreach ($successes as $success) { ?>
      <article class="success">
        <p><?=$success?></p>
      </article>
      <?php } clearMessages(); ?>
    </section>