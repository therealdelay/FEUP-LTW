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

	<div id=<?= $todo['todo_id']?> class="todo_only">
		<h3><?= $todo['name']?></h3>
		<span><?= $todo['limit_date']?></span>
		<a href="#"><button name="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
		<?php if($todo['done'] == -1){?>
			<a href="#"><button name="Check"><i class="fa fa-check-square-o" aria-hidden="true"></i></button></a>
		<?php } else {?>
			<a href="#"><button name="Check"><i class="fa fa-square-o" aria-hidden="true"></i></button></a>
		<?php } ?>
		<a href="#"><button name="Remove"><i class="fa fa-1x fa-trash" aria-hidden="true"></i></button></a>
	</div>
	<?php } ?>
	<div id="ultimo">
		<a href="#"><img src="images/addIcon.png"></a>
	</div>
</section>