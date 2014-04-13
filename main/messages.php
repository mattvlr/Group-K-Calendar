<?php

$messagelist = "A<br>B<br>";
$msgs = 0;

if($msgs == 0);
{
$msgs = 'no';
}
?>

<html>
<head>
<title>Messaging</title>
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/bootstrap/css/signin.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="template.css">
<link href="/bootstrap/css/dashboard.css" rel="stylesheet">
</head>
<body><center><h1>Messaging</h1>
<br> You have <?php echo $msgs; ?> unread messages.<br>
<?php
echo $messagelist;
?>
</center></div></body></html>