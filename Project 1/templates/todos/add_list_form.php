
<div id="register">
	<form action="../../add_list.php" method="post">
		<label>Title
			<input type="text" placeholder="write here..." name="title" required> 
		</label>
		<label>Priority
			<input type="number" placeholder="priority" min="0" max="3" name="priority">
		</label>
		<label>Category
			<!-- Use ajax to create dropdown? -->
			<input type="text" placeholder="category" name="category" required>
		</label>
		<input type="submit" value="Add">
	</form>
</div>
