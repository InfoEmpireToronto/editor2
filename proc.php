<?php

include('functions.php');

$data = [
	'title' => $_REQUEST['title'],
	'body' => $_REQUEST['body'],
	'metaTitle' => $_REQUEST['metaTitle'],
	'metaDesc' => $_REQUEST['metaDesc'],
	'active' => $_REQUEST['active'],
	'pubDate' => $_REQUEST['pubDate'],
	'type' => $_REQUEST['type']
];

if(isset($_REQUEST['category']))
{
	$data['category'] = $_REQUEST['category'];
}

if(isset($_REQUEST['id']))
{

	$article = new Article($_REQUEST['id']);
	$article->update($data);


}else{

	$a = new Article();
	$a->add($data);

}

header("Location: ".$config['AppURL']); 
// dd($_REQUEST);
?>