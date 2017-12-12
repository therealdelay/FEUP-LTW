<div id="add_form">
	<label>What do you have to do?
		<input type="text" placeholder="write here..." name="name" required> 
	</label>
	<label>Limit Date
		<input type="date" name="date" required>
	</label>
	<input type="submit" value="Add">
	<input type="submit" value="Cancel">
</div>

<div id="edit_form">
	<label>What do you have to do?
		<input type="text" placeholder="write here..." name="name">
	</label>
	<label>Limit Date
		<input type="date" name="date">
	</label>
	<input type="submit" value="Save">
	<input type="submit" value="Cancel">
</div>

<div id="todos_only">
	<?php foreach ($todos as $todo) { ?>

		<?php
		$check;
		if($todo['done'] == 1)
			$check = 'check';
		else 
			$check = 'not_check';
		?>

		<div id=<?= $todo['todo_id']?> class="todo_only <?= $check ?>">
			<h3><?= $todo['name']?></h3>
			<span><?= date_format(date_create($todo['limit_date']), "d/m/Y")?></span>
				<button name="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<?php if($todo['done'] == 1){?>
				<button name="Check"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
			<?php } else {?>
				<button name="Check"><i class="fa fa-square-o" aria-hidden="true"></i></button>
			<?php } ?>
				<button name="Remove"><i class="fa fa-1x fa-trash" aria-hidden="true"></i></button>
				<?php
					$class; 
					if(sizeof($comments[$todo['todo_id']]) > 0)
						$class = "comments";
					else
						$class = "no_comments";
				?>
				<div class=<?= $class ?>>
					<?php foreach($comments[$todo['todo_id']] as $comment){?>
						<div class="comment">
							<p><?=$comment['usr_username']?></p>
							<span><?=date_format(date_create($comment['date_written']), "d/m/Y")?></span>
							<p><?=$comment['comment_text']?></p>
						</div>
					<?php } ?>
					<button><i class="fa fa-comment" aria-hidden="true"></i></button>
					<div class="add_comment">
						<input type="text" placeholder="write here your comment" name="comment">
						<input type="submit" name="add_comment" value="Add">
						<input type="submit" name="cancel_comment" value="Cancel">
					</div>
				</div>
		</div>
	<?php } ?>
	<div id="ultimo">
		<a href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
	</div>
</div>