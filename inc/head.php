<?php 
header("Content-Type: text/html; charset=ISO-8859-1");

include_once('config.php'); 
include_once('functions.php');

if(!isset($_SESSION['UserData']['Username']) && $_SERVER['SCRIPT_NAME'] != $config['AppLocation'].'login.php'){
	header("location: {$config['AppURL']}login.php");
	exit;
}



?>

<!DOCTYPE html>
<html>
<head>
<title>Editor 2.0</title>

    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


<script type="" src="node_modules/jquery/dist/jquery.min.js"></script>
<script type="" src="node_modules/popper.js/dist/umd/popper.min.js"></script>
<script type="" src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<script type="" src="node_modules/tinymce/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: '#mytextarea',  // change this value according to your HTML
	plugins: [
	    'advlist autolink lists link image imagetools charmap anchor',
	    'searchreplace visualblocks fullscreen',
	    'insertdatetime media table paste wordcount'
	  ],
	file_browser_callback: function(field_name, url, type, win) {
	    // win.document.getElementById(field_name).value = 'my browser value';
	    console.log('file browser callback', field_name, url, type, win);

	},
	images_upload_url: 'postAcceptor.php',
	  automatic_uploads: true,
	// menubar: "insert",
	// toolbar: "media"
  });
  </script>




</head>

<body>