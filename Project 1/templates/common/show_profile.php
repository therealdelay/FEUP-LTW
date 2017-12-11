	<div id="verification">
		<p>Please insert your password: </p>
		<input type="password" name="password">
		<input type="submit" name="Submit">
	</div>

	<div id="profile">
		<h3 id="name"><?php echo $name ?></h3><br>
		<h3 id="username"><?php echo $username ?></h3><br>
		<h3 id="email"><?php echo $email ?></h3><br>
		<img src="<?php echo $image; ?>" alt="profilepic">
		<button id="edit_profile" onclick="location.href='edit_profile.php';">Edit profile</button>
		<button id="delete_profile">Delete Account</button>
	</div>