<?php

//GET USERS SETTINGS FROM DATABASE TO POPULATE FORM

//GENERATE FORM

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
</head>
<body><center><h1>Messaging</h1></center>
<br> You have <?php echo $msgs; ?> unread messages<br>
<?php
echo $messagelist;
?>
</div></body></html>