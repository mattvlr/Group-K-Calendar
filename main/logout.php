<html>
<head>
<title>Logout</title>
<link rel="stylesheet" type="text/css" href="template.css">
</head>
<body><center><h1>Logged Out</h1></center>
<center>Redirecting to <a href="index.php">index</a> in 5</center>
<?php
$db = '/mysql/_db.php';
require_once($db);
  header( 'refresh:5;url=index.php');
?>
</div></body></html>