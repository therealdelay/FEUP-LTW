<div id="add_form">
	<label>What do you have to do?
		<input type="text" placeholder="write here..." name="name" required> 
	</label>
	<label>Limit Date
		<input type="date" placeholder="limit date" name="date" required>
	</label>
	<input type="submit" value="Add">
	<input type="submit" value="Cancel">
</div>

<div id="edit_form">
	<label>What do you have to do?
		<input type="text" placeholder="write here..." name="name" required>
	</label>
	<label>Limit Date
		<input type="date" placeholder="limit date" name="date" required>
	</label>
	<input type="submit" value="Save">
	<input type="submit" value="Cancel">
</div>

<section id="todos_only">
	<?php foreach ($todos as $todo) { ?>
	<div id=<?= $todo['todo_id']?> class="todo_only">
		<p><?= $todo['name']?></p>
		<span><?= $todo['limit_date']?></span>
		<a href="#"><button name="Edit">Edit</button></a>
		<a href="#"><button name="Done">Done</button></a>
		<a href="#"><button name="Remove">Remove</button></a>
	</div>
	<?php } ?>
	<div class="todo_only">
		<img src="images/addIcon.png">
	</div>
</section>