<?php 
include('inc/head.php');
include('inc/nav.php'); 
include('functions.php');

$articleObj = new Article($_GET['id']);
$article = $articleObj->article();

?>
<section class="pt-5 pb-5">

<div class="container">
  <div class="row">
   
    <div class="col-lg">
      <form method="post" action="<?=$config['AppURL'];?>proc.php">
		  <div class="form-group">
			   <label for="type1"><h3>Type of post:</h3></label>
			   <select name="type" class="form-control">
      		<option value="article">Article</option>
      		<option value="FAQ">FAQ</option>

      	</select>
		  </div>
		  
		  <div class="form-group">
      	<label><h3>Title:</h3></label> <input type="text" name="title" value="<?=$article['title']?>" class="form-control" required>
		  </div>
		  <div class="form-group">
	    <label><h3>Contents:</h3></label> <textarea id="mytextarea" rows="20" name="body" class="form-control"><?=$article['body']?></textarea>
		  </div>
		  <div class="form-group">
      	<label><h3>Meta Title:</h3></label> <input type="text" name="metaTitle" value="<?=$article['metaTitle']?>" class="form-control">
		  </div>
		  <div class="form-group">
      	<label><h3>Meta Description:</h3></label> <input type="text" name="metaDesc" value="<?=$article['metaDesc']?>" class="form-control">
		  </div>
		   
		  <div class="form-group">
		  <label><h3>Publication Date:</h3></label> <input type="date" name="pubDate" value="<?=$article['pubDate']?>" class="form-control" required>
		  </div>

		  
		  <div class="form-group">
		  <div class="custom-control custom-checkbox">
  <input type="checkbox" class="custom-control-input" id="customCheck1" name="active" value="1" <?=$article['active']?'checked':'';?>>
  <label class="custom-control-label" for="customCheck1"> <strong>Active</strong></label>
</div>
			    </div>
		  
		  
		  
		  <div class="form-group">
		  
		  
	    <button type="submit" class="btn btn-primary btn-lg">Save</button>
      	
      	<input type="hidden" name="id" value="<?=$article['id']?>" required>
		  </div>
	  </form>
    </div>
  </div>
</div>
</section>
<?php include('inc/foot.php'); ?>
