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
				<input type="text" placeholder="username" name="new_username" value=<?= $new_username ?> required> 
			</label>
			<label>New name
				<input type="text" placeholder="name" name="name" value=<?= $name?> required>
			</label>
			<label>New e-mail
				<input type="email" placeholder="e-mail" name="email" value=<?= $email?> required>
			</label>
			<label>New image URL
				<input type="text" placeholder="image URL" name="image" value=<?= $image?> required>
			</label>
			<label>Current password
				<input type="password" placeholder="password" name="old_password" required>
			</label>
			<label>New password
				<input type="password" placeholder="password" name="new_password" required>
			</label>
			<input type="submit" value="Save changes">
		</form>
	</div>
</body>
</html>