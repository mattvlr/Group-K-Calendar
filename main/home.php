<?php
// make welcome header

if(isset($_SESSION['first_name']) && isset($_SESSION['last_name']))
{
$body = '<center><div class="jumbotron" align="left" style="padding-left:300px;">
  <h1>Welcome, '. $_SESSION['first_name'] .'.</h1>
  <p>This is Group Ks Kalendar project.<br>Group scheduling, redesigned.</p>
  <p><a class="btn btn-primary btn-lg" href="?act=month">Get started</a></p>
</div></center>';
}
else
{
$body = '<center><div class="jumbotron" align="left" style="padding-left:300px;">
  <h1>Welcome.</h1>
  <p>This is Group Ks Kalendar project.<br>Group scheduling, redesigned.</p>
  <p><a class="btn btn-primary btn-lg" href="?act=login">Get started</a></p>
</div></center>';
}
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