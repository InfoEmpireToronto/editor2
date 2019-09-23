<?php include_once('config.php'); ?>

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