<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>To Do - Add</title>
	<link rel="stylesheet" type="text/css" href="../../css/register_form.css">
</head>
<body>
	<div id="register">
		<form action="../../add_todo.php" method="post">
			<label>What do you have to do?
				<input type="text" placeholder="write here..." name="name" required> 
			</label>
			<label>Limit Date
				<input type="date" placeholder="limit date" name="date" required>
			</label>
			<label>Priority
				<input type="number" placeholder="priority" min="0" max="3" name="priority">
			</label>
			<!-- add imput to categories-->
			<label>Category
				<input type="text" placeholder="category" name="category">
			</label>
			<input type="submit" value="Add">
		</form>
	</div>
</body>
</html>