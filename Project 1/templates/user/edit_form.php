<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>To Do - Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="css/register_form.css">
</head>
<body>
	<div id="edit">
		<form action="edit.php" method="post">
			<legend>Edit Profile</legend>
			<label>Old username
				<input type="text" placeholder="username" name="old_username" value=<?= $old_username ?> required disabled> 
			</label>
			<label>New username
				<input type="text" placeholder="username" name="new_username" value=<?= $new_username ?> pattern=".{3,}" title="Must have at least 3 characters" required> 
			</label>
			<label>New name
				<input type="text" placeholder="name" name="name" value="<?= $name?>" pattern="[A-Z][a-z]*([\s][A-Z][a-z]*)*" title="Can have more than 1 name, all starting with 1 uppercase letter" required>
			</label>
			<label>New e-mail
				<input type="text" placeholder="e-mail" name="email" value=<?= $email?> pattern="[^@]*@[^@]*[\.].*" title="example@example.example" required>
			</label>
			<label>New image URL
				<input type="text" placeholder="image URL" name="image" value=<?= $image?> required>
			</label>
			<label>Current password
				<input type="password" placeholder="password" name="old_password" required>
			</label>
			<label>New password
				<input type="password" placeholder="password" name="new_password"  pattern="(?=.*[-_?!@#+*$%&/()=])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" title="Must have 8 to 32 characters, including 1 lowercase and 1 uppercase, 1 number and 1 of the following -_?!@#+*$%&/()=" required>
			</label>
			<input type="submit" value="Save changes">
		</form>
	</div>

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
</body>
</html>