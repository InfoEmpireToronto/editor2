<?php

include('functions.php');


$a = new Article();
$a->addCat($_REQUEST['title']);


header("Location: ".$config['AppURL'].'addCategory.php'); 
// dd($_REQUEST);
?>