<?php include('inc/head.php'); ?>

<?php include('inc/nav.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-lg">
      <form method="post" action="proc.php">
        Title: <input type="text" name="title" value="" required>
      Body: <textarea id="mytextarea" name="body"></textarea>
        Meta Title: <input type="text" name="metaTitle" value="">
        Meta Description: <input type="text" name="metaDesc" value="">
        Type: <select name="type">
          <option value="article">Article</option>
          <option value="FAQ">FAQ</option>

        </select>
        Publication Date: <input type="date" name="pubDate" value="" required>
        Active: <input type="checkbox" name="active" value="1" >
      <button>Save</button>
        
      </form>
    </div>
  </div>
</div>

<?php include('inc/foot.php'); ?>
