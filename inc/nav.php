<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  	<div class="container">
		<a class="navbar-brand" href='<?=$config['AppURL'];?>'>BLOG/FAQ Editor</a>
		<a href='<?=$config['AppURL'];?>' class="nav-link btn btn-light">View all</a> 
		<a href='<?=$config['AppURL'];?>add.php' class="nav-link btn btn-danger">Add Blog/FAQ</a>

		<?php if($config['enable_categories']) { ?>
		<li><a href='<?=$config['AppURL'];?>addCategory.php' >Add Category</a></li>
		<?php } ?>

	</div>
</nav>