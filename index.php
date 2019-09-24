<?php 
include('inc/head.php'); 
include('inc/nav.php'); 

$a = new Article();
$all = $a->getAll();

?>

<section class="pt-5 pb-5">

<div class="container">
  <div class="row">
    <div class="col-lg">
<div class="table-responsive-sm">
  <table class="table table-bordered">
    
     <thead class="thead-dark">
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Type of post</th>
      <th scope="col">Date added</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 

    foreach($all as $article)
    {
      echo "<tr>
            <td>
              <h6 class='pt-2'>{$article['title']}</h6>
            </td>
            <td>
              <p class='pt-2 mb-0 text-capitalize'>{$article['type']}</p>
            </td>
            <td>
              <p class='pt-2 mb-0 text-nowrap'>{$article['pubDate']}</p>
            </td>
            <td width='80'>
              <a href='{$config['AppURL']}edit.php?id={$article['id']}' class='btn btn-danger'>Edit</a>
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
