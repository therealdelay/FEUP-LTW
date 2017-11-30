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
		<input type="text" placeholder="write here..." name="name">
	</label>
	<label>Limit Date
		<input type="date" placeholder="limit date" name="date">
	</label>
	<input type="submit" value="Save">
	<input type="submit" value="Cancel">
</div>

<section id="todos_only">
	<?php foreach ($todos as $todo) { ?>

	<?php
	$check; 
	if($todo['done'] == 1)
		$check = 'check';
	else 
		$check = 'not_check';
	?>

	<div id=<?= $todo['todo_id']?> class="todo_only <?= $check ?>">
		<p><?= $todo['name']?></p>
		<span><?= $todo['limit_date']?></span>
		<a href="#"><button name="Edit">Edit</button></a>
		<?php if($todo['done'] == -1){?>
			<a href="#"><button name="Check">Check</button></a>
		<?php } else {?>
			<a href="#"><button name="Check">Uncheck</button></a>
		<?php } ?>
		<a href="#"><button name="Remove">Remove</button></a>
	</div>
	<?php } ?>
	<div class="todo_only">
		<img src="images/addIcon.png">
	</div>
</section>