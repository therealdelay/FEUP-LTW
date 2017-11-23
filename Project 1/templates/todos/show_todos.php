<section id="todos_only">
	<?php foreach ($todos as $todo) { ?>
		<div class="todo_only">
			<p><?= $todo['name']?></p>
			<span><?= $todo['limit_date']?></span>
		</div>
	<?php } ?>
</section>