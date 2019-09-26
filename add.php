<?php include('inc/head.php'); ?>

<?php include('inc/nav.php'); ?>

<section class="pt-5 pb-5">
<div class="container">
  <div class="row">
    <div class="col-lg">
      <form method="post" action="<?=$config['AppURL'];?>proc.php">
      
      
       <div class="form-group">
         <label for="type1"><h3>Type of post:</h3></label>
         <select name="type" class="form-control">
          <option value="article">Article</option>
          <option value="news">News</option>
          <option value="FAQ">FAQ</option>

        </select>
      </div>


      
      <div class="form-group">
        <label><h3>Title:</h3></label> <input type="text" name="title" value="" class="form-control" required>
      </div>
      <div class="form-group">
      <label><h3>Contents:</h3></label> <textarea rows="20" id="mytextarea" name="body" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label><h3>Meta Title:</h3></label> <input type="text" name="metaTitle" value="" class="form-control">
      </div>
      <div class="form-group">
        <label><h3>Meta Description:</h3></label> <input type="text" name="metaDesc" value="" class="form-control">
      </div>
       
      <div class="form-group">
      <label><h3>Publication Date:</h3></label> <input type="date" name="pubDate" value="" class="form-control" required>
      </div>

<?php if($config['enable_categories']) { ?>
       <div class="form-group">
         <label for="type1"><h3>Category:</h3></label>
                  <input type="text" name="category" value="<?=$article['category']?>" class="form-control" >

        <!--  <select name="category" class="form-control">
          <option value="0">N/A</option>

          <?php 
            $a = new Article();
            foreach($a->getAllCats() as $cat)
            {
              echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
            }
          ?>

        </select> -->
      </div>
<?php } ?>
      
       <div class="form-group">
      <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="customCheck1" name="active" value="1">
        <label class="custom-control-label" for="customCheck1"> <strong>Active</strong></label>
      </div>
          </div>
      
      <div class="form-group">
      
      
      <button type="submit" class="btn btn-primary btn-lg">Save</button>
      
      </div>
      
<!--
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
-->
        
      </form>
    </div>
  </div>
</div>

<?php include('inc/foot.php'); ?>
