<section id="todos">
	<?php foreach ($todos as $todo) { ?>
		<div class="todo">
			<h2><?= $todo['name']?></h2>
			<p><?= $todo['limit_date']?></p>
			<!--adicionar categorias e o resto-->
		</div>
	<?php } ?>
</section>