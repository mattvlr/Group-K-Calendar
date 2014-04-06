<?php
// make welcome header
$body = '<center><div class="jumbotron" align="left" style="padding-left:300px;">
  <h1>Welcome '. $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . '!</h1>
  <p>This is Group Ks Kalendar project.</p>
  <p><a class="btn btn-primary btn-lg">Get started</a></p>
</div></center>'

?>

<html>
<head>
<title>Home</title>
</head> 
<body>
<?php
echo $body;
?>
</div></body></html>