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
				<input type="text" placeholder="username" name="username" pattern=".{3,}" title="Must have at least 3 characters" required>
			</label>
			<label>Name
				<input type="text" placeholder="name" name="name" pattern="[A-Z][a-z]*([\s][A-Z][a-z]*)*" title="Must start with 1 uppercase letter and can have more than 1 name" required>
			</label>
			<label>E-mail
				<input type="text" placeholder="e-mail" name="email" pattern="[^@]*@[^@]*[\.].*" title="example@example.example" required>
			</label>
			<label>Image URL
				<input type="text" placeholder="image URL" name="image" required>
			</label>
			<label>Password
				<input type="password" placeholder="password" name="password" pattern="(?=.*[-_?!@#+*$%&/()=])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" title="Must have 8 to 32 characters, including 1 lowercase and 1 uppercase letter, 1 number and 1 of the following -_?!@#+*$%&/()=" required>
			</label>
			<input type="submit" value="Register">
		</form>
	</div>
</body>
</html>