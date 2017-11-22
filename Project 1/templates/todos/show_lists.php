<section id="todos">
	<?php foreach ($lists as $list) { ?>
		<div class="todo">
			<h2><?= $list['title']?></h2>

			<?php foreach ($categories[$list['id']] as $cat) { ?>
				<p><?= $cat['cat_name']?></p>
			<?php } ?>

			<?php foreach ($todos[$list['id']] as $todo) { ?>
				<p><?= $todo['name']?></p>
				<p><?= $todo['limit_date']?></p>
			<?php } ?>
			<!--adicionar categorias e o resto-->
		</div>
	<?php } ?>
</section>