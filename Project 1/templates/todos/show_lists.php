<section id="lists">
	<?php foreach ($lists as $list) { ?>
		<div class="list" class="<?= $list['priority']?>">
			<h2><?= $list['title']?></h2>

			<div class="todos">
				<?php foreach ($todos[$list['id']] as $todo) { ?>
					<div class="todo">
						<p><?= $todo['name']?></p>
						<p><?= $todo['limit_date']?></p>
					</div>
				<?php } ?>
			</div>

			<div class="categories">
				<?php foreach ($categories[$list['id']] as $cat) { ?>
					<div class="category">
						<p><?= $cat['cat_name']?></p>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
</section>