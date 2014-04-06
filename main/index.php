<?php
//login script that checks for cookies or sessions and loads that data
require_once('login.php');
require_once('mysql/_db.php');
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="template.css">
    <script src="/main/calendar/CalendarJsFunctions.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			<?php echo '$("#sidebar-small-month").load("/main/calendar/sbsmi.php?month='.$mc.'&year='.$yc.'");'; ?>
		});
	</script>


    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/bootstrap/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="startTime()"></body>
<?php
require_once('navbar.php');
require_once('sidebar.php');

if(isset($_GET['act']))
{
	if($_GET['act']== 'register')
	{
		$body = require("register.php");
	}
	if($_GET['act']== 'help')
	{
		$body = require("help.php");
	}
		if($_GET['act']== 'groups')
	{
		$body = require("groups.php");
	}
		if($_GET['act']== 'login')
	{
		$body = require("loginform.php");
	}

		if($_GET['act']== 'home')
	{
		$body = require("home.php");
	}
		if($_GET['act']== 'forgot')
	{
		$body = require("forgot.php");
	}
	if($_GET['act']== 'month')
	{
		$body = require("calendar/month.php");
	}
	if($_GET['act']== 'year')
	{
		$body = require("calendar/year.php");
	}
	if($_GET['act']== 'day')
	{
		$body = require("calendar/day.php");
	}
	if($_GET['act']== 'messages')
	{
	//body = require("login_inline.php");
	}
	if($_GET['act'] =='FAQ')
	{
	$body = require("faq.php");
	}
	if($_GET['act'] =='logged')
	{
	$body = require("logout.php");
	}



}
else
{
	//$body = require("calendar/month.php");
	$body = require('loginform.php');
}
?>



