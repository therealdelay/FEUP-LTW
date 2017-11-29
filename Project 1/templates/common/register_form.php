<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>To Do - Register</title>
	<link rel="stylesheet" type="text/css" href="../../css/register_form.css">
</head>
<body>
	<div id="register">
		<form action="../../register.php" method="post">
			<label>Username
				<input type="text" placeholder="username" name="username" required> 
			</label>
			<label>Name
				<input type="text" placeholder="name" name="name" required>
			</label>
			<label>E-mail
				<input type="email" placeholder="e-mail" name="email" required>
			</label>
			<label>Image URL
				<input type="text" placeholder="image URL" name="image" required>
			</label>
			<label>Password
				<input type="password" placeholder="password" name="password" required>
			</label>
			<input type="submit" value="Register">
		</form>
	</div>
</body>
</html>



<!-- Add Footer -->	