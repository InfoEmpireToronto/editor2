<?php 
include('inc/head.php'); 
include('inc/nav.php'); 

$a = new Article();
$categories = $a->getAllCats();

?>

<div class="container">
  <div class="row">
    <div class="col-lg">
      <h2>Add Category</h2>
      <form method="post" action="<?=$config['AppURL'];?>procCat.php">
        Name: <input type="text" name="title" value="" required>
      
      <button>Save</button>
        
      </form>
      <hr />
      <h2>All Categories</h2>

      <form method="post" action="<?=$config['AppURL'];?>procCat.php">
        <input type="hidden" name="updateAll" value="1">
      <?php
      if(count($categories))
        foreach($categories as $cat)
        {
          echo "<div class='row'>
            <div class='col-lg'>
              <input type='text' value='{$cat['name']}' name='c[{$cat['id']}]' />
            </div>
            </div>";
        }

      ?>
      <button>Save</button>
      </form>
    </div>
  </div>
</div>

<?php include('inc/foot.php'); ?>
