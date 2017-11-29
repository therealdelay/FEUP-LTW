<div id="add_form">
	<label>Title
		<input type="text" placeholder="write here..." name="title" required> 
	</label>
	<label>Priority
		<input type="number" placeholder="priority" min="0" max="3" name="priority">
	</label>
	<label>Categories
		<select id="categories" multiple></select>
	</label>
	<button id="add_category">Add New Category</button>
	<div id="new_categories">
		
	</div>
	<input type="submit" value="Add">
	<input type="submit" value="Cancel">
</div>

<section id="lists">
	

	<?php foreach ($lists as $list) { ?>

	<?php
	$priority; 
	if($list['priority'] == 1)
		$priority = 'p1';
	else if($list['priority'] == 2)
		$priority = 'p2';
	else if($list['priority'] == 3)
		$priority = 'p3';
	?>

	<a href="list_page.php?list_id=<?= $list['list_id']?>">
		<div class="list <?= $priority?>">
			<h2><?= $list['title']?></h2>

			<div class="todos">
				<?php foreach ($todos[$list['id']] as $todo) { ?>
				<div class="todo">
					<p><?= $todo['name']?></p>
					<span><?= $todo['limit_date']?></span>
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
		</div></a>
		<?php } ?>
		<div class="list">
			<img src="images/addIcon.png">
		</div>
	</section>