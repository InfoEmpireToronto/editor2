<?php 
include('inc/head.php'); 
include('inc/nav.php'); 
include('functions.php');



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

      <?php
      if(count($categories))
        foreach($categories as $cat)
        {
          echo "<div class='row'>
            <div class='col-lg'>
              {$cat['name']}
            </div>
            <div class='col-lg'>
              <a href='{$config['AppURL']}edit.php?id={$cat['id']}'>Edit</a>
            </div>
            </div>";
        }

      ?>

    </div>
  </div>
</div>

<?php include('inc/foot.php'); ?>
