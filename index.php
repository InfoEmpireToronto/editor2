<?php 
include('inc/head.php'); 
include('inc/nav.php'); 
include('functions.php');

$a = new Article(1);
$all = $a->getAll();

// dd($all); 
?>



<div class="container">
  
    <?php 

    foreach($all as $article)
    {
      echo "<div class='row'>
            <div class='col-lg'>
              {$article['title']}
            </div>
            <div class='col-lg'>
              <a href='/edit.php?id={$article['id']}'>Edit</a>
            </div>
            </div>";
    }

    ?>
    

</div>

<?php include('inc/foot.php'); ?>
