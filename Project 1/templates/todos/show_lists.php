<div id="add_form">
	<label>Title
		<input type="text" placeholder="write here..." name="title" required> 
	</label>
	<label>Priority
		<select name="priority">
			<option value="1">High</option>
			<option value="2">Medium</option>
			<option value="3">Low</option>
		</select>
	</label>
	<button id="add_category_add_form">Add New Category</button>
	<div class="new_categories"></div>
	<input type="submit" value="Add">
	<input type="submit" value="Cancel">
</div>


<div id="edit_form">
	<label>Title
		<input type="text" placeholder="write here..." name="title" required> 
	</label>
	<label>Priority
		<select name="priority">
			<option value="1">High</option>
			<option value="2">Medium</option>
			<option value="3">Low</option>
		</select>
	</label>
	<button id="add_category_edit_form">Add New Category</button>
	<div class="new_categories"></div>
	<input type="submit" value="Save">
	<input type="submit" value="Cancel">
</div>

<div id="invite_user_form">
	<label>Username
		<input type="text" placeholder="username" name="username" required>
	</label>
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

<!--
<div id="notifications">
	<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
</div>-->
<div id="notifications">
	<input type="checkbox" id="hamburger2">
	<label class="hamburger" for="hamburger2"></label>

	<div id="notifications_box">
		<ul>
			
		</ul>
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
	
	$alert = "";

	$check;
	if($list['done'] == 1)
		$check = 'check';
	else 
		$check = 'not_check';
	?>

	<div>
		<div id=<?= $list['id']?> class="list <?= $priority?> <?= $check?>" onclick="location.href='list_page.php?list_id=<?= $list['list_id']?>'">
			<h2><?= $list['title']?></h2>

			<div class="todos">
				<?php foreach ($todos[$list['id']] as $todo) { ?>
				<?php
					$todoStatus;
					if($todo['done'] == -1){
						$todoStatus = getTimeDiff($todo['limit_date']);
	
					
						if($alert != "Overtime" && $todoStatus == "Overtime")
							$alert = "alert";
					}
					else
						$todoStatus = "Done";
				?>
				
				<div class="todo">
					<p><?= $todo['name']?></p>
					<span><?= $todoStatus ?></span>
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
			
			<button name="Invite"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
			<button name="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<button name="Remove"><i class="fa fa-1x fa-trash" aria-hidden="true"></i></button>
			<i class="mark fa fa-exclamation <?= $alert?>" aria-hidden="true"></i>
		</div>
	</div>
		<?php } ?>
		<div id="ultimo">
			<a href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
		</div>
</section>