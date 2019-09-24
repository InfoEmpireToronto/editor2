<?php 
include('inc/head.php'); 
include('inc/nav.php'); 
include('functions.php');



$a = new Article();
$all = $a->getAll();

?>

<section class="pt-5 pb-5">

<div class="container">
  <div class="row">
    <div class="col-lg">
<div class="table-responsive-sm">
  <table class="table table-bordered">
  <tbody>
    <?php 

    foreach($all as $article)
    {
      echo "<tr>
            <td>
              <h6 class='pt-2'>{$article['title']}</h6>
            </td>
            <td width='80'>
              <a href='{$config['AppURL']}edit.php?id={$article['id']}' class='btn btn-dark'>Edit</a>
            </td>
            </tr>";
    }

    ?>
    </tbody>
  </table>
  </div>
    </div>
</div>
</div>
</section>

<?php include('inc/foot.php'); ?>
