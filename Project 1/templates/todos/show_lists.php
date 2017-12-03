<div id="add_form">
	<label>Title
		<input type="text" placeholder="write here..." name="title" required> 
	</label>
	<label>Priority
		<input type="number" placeholder="priority" min="0" max="3" name="priority">
	</label>
	<button id="add_category">Add New Category</button>
	<div id="new_categories"></div>
	<input type="submit" value="Add">
	<input type="submit" value="Cancel">
</div>


<div id="edit_form">
	<label>Title
		<input type="text" placeholder="write here..." name="title" required> 
	</label>
	<label>Priority
		<input type="number" placeholder="priority" min="0" max="3" name="priority">
	</label>
	<button id="add_category">Add New Category</button>
	<div id="new_categories"></div>
	<input type="submit" value="Add">
	<input type="submit" value="Cancel">
</div>

<div id="search">
	<label>Search
		<input type="search" placeholder="Title" name="search_title"> 
	</label>
	<!--
	<a id="toggle_advanced_search" href="#">
		Advanced Search
	</a>
	-->
	<input type="checkbox" id="hamburger">
	<label class="hamburger" for="hamburger"></label>
	
	<div id="advanced_search">
		<label>Priority
			<select name="priority">
				<option value="">All</option>
				<option value="p1">High</option>
				<option value="p2">Medium</option>
				<option value="p3">Low</option>
			</select>
		</label>
		<label>Categories
			<input type="text" placeholder="Category" name="category">
		</label>
	</div>
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
		<div id=<?= $list['id']?> class="list <?= $priority?>">
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
			
			<button name="Edit">Edit</button>
			<button name="Remove">Remove</button>
		</div>
	</a>
		<?php } ?>
		<div id="ultimo">
			<img src="images/addIcon.png">
		</div>
</section>