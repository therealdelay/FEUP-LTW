<section id="todos_only">
	<?php foreach ($todos as $todo) { ?>
		<div class="todo_only">
			<p><?= $todo['name']?></p>
			<span><?= $todo['limit_date']?></span>
			<a href="#"><button>Edit</button></a>
			<a href="#"><button>Done</button></a>
		</div>
	<?php } ?>
	<div class="todo_only">
		<a href="add_todo_form.php"><img src="images/addIcon.png"></a>		
	</div>
</section>