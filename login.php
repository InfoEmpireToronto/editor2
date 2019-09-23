<?php 
include('inc/head.php'); 
include('inc/nav.php'); 
include('functions.php');


if(isset($_REQUEST['p']))
{
  if($_REQUEST['p'] == $config['password'] && $_REQUEST['u'] == $config['login'])
  {
    $_SESSION['UserData']['Username'] = '1';
    header('location: '.$config['AppURL']);
  }
}

?>



<div class="container">
  
   <form action="login.php" method="POST">
     User: <input type="text" name='u' />
     Password: <input type="password" name='p' />
     <button>Submit</button>
   </form>

</div>

<?php include('inc/foot.php'); 
dd($_REQUEST);

?>