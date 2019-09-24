<?php include_once('config.php'); 
session_start();

// print_r($_SERVER['SCRIPT_NAME']);die();

if(!isset($_SESSION['UserData']['Username']) && $_SERVER['SCRIPT_NAME'] != $config['AppLocation'].'login.php'){
	header("location: {$config['AppURL']}login.php");
	exit;
}


?>

<!DOCTYPE html>
<html>
<head>
<title>Editor 2.0</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


<script type="" src="node_modules/jquery/dist/jquery.min.js"></script>
<script type="" src="node_modules/popper.js/dist/umd/popper.min.js"></script>
<script type="" src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<script type="" src="node_modules/tinymce/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: '#mytextarea',  // change this value according to your HTML
	plugins: [
	    'advlist autolink lists link image charmap print preview anchor',
	    'searchreplace visualblocks code fullscreen',
	    'insertdatetime media table paste code help wordcount'
	  ],
	// menubar: "insert",
	// toolbar: "media"
  });
  </script>




</head>

<body>