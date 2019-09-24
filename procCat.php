<?php

include('functions.php');

// dd($_REQUEST);

$a = new Article();

if(isset($_REQUEST['updateAll']))
{
	foreach($_REQUEST['c'] as $catID => $name)
	{
		$a->updateCat($catID, $name);
	}
}else{
	$a->addCat($_REQUEST['title']);
	
}

header("Location: ".$config['AppURL'].'addCategory.php'); 


?>