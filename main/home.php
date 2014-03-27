<?php
// make welcome header
if(isset($_SESSION['first_name']) && isset($_SESSION['last_name']))
{
$body= '<center><h1>WELCOME '. $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . '</h1></center>';
}
else
{
$body="<center><h1>Welcome to group K's calendar Project<h1></center>";
}

?>

<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="template.css">
</head>
<body>
<?php
echo $body;
?>
Get started by logging in or registering.
</div></body></html>