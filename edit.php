<?php 
include('inc/head.php');
include('inc/nav.php'); 
include('functions.php');

$articleObj = new Article($_GET['id']);
$article = $articleObj->article();

?>

<div class="container">
  <div class="row">
   
    <div class="col-lg">
      <form method="post" action="<?=$config['AppURL'];?>proc.php">
      	Title: <input type="text" name="title" value="<?=$article['title']?>" required>
	    Body: <textarea id="mytextarea" name="body"><?=$article['body']?></textarea>
      	Meta Title: <input type="text" name="metaTitle" value="<?=$article['metaTitle']?>">
      	Meta Description: <input type="text" name="metaDesc" value="<?=$article['metaDesc']?>">
      	Type: <select name="type">
      		<option value="article">Article</option>
      		<option value="FAQ">FAQ</option>

      	</select>
      	Publication Date: <input type="date" name="pubDate" value="<?=$article['pubDate']?>" required>
      	Active: <input type="checkbox" name="active" value="1" <?=$article['active']?'checked':'';?>>
	    <button>Save</button>
      	
      	<input type="hidden" name="id" value="<?=$article['id']?>" required>
	  </form>
    </div>
  </div>
</div>

<?php include('inc/foot.php'); ?>
