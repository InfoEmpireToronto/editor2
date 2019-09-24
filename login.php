<?php 
include_once('functions.php');


if(isset($_REQUEST['p']))
{
  if($_REQUEST['p'] == $config['password'] && $_REQUEST['u'] == $config['login'])
  {
    $_SESSION['UserData']['Username'] = '1';
    header('location: '.$config['AppLocation']);
  }
}

include('inc/head.php'); 
include('inc/nav.php'); 
?>


<section class="pt-5 pb-5">

<div class="container">
  <div class="col-md-6 offset-md-3">
  
   <form action="login.php" method="POST">
     <div class="form-group">
       <label>User:</label>
      <input type="text" name='u' class="form-control" />
     </div>
       <div class="form-group">
       <label>Password:</label>
      <input type="password" name='p' class="form-control"  />
     </div>
        <div class="form-group text-center">
     <button class="btn btn-primary btn-lg">Submit</button></div>
   </form>
</div>
</div>
</section>

<?php include('inc/foot.php'); 

?>