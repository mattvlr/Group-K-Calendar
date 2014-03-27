<!DOCTYPE html>
<?php
echo "HI";
include 'logout.php';
//require 'navbar.php';  //Generate Navbar
include 'calendarFunctions.php';
/////////////Select Body based on GET act

$leftbar = '';
if(isset($id)) //user is logged in
{
	//$body = require("logout.php");
	$leftbar = '<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="list-group-item">
              <span class="badge">14</span>
                Messages
            <li class="list-group-item">
               <span class="badge">3</span>
                Upcoming Events
            <li><a href="#">Group Invites</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active"><a href="?act=month">Month</a></li>
            <li><a href="?act=year">Year Test</a></li>
            <li><a href="?act=day">Day Test</a></li> 
          </ul>
          '. draw_small_month(date("m"),date("Y")) .'
          <br>
          Check out the login form <a href="login.php">here.</a>
		  </div>';
}
else
{
//no one logged in
}



echo $leftbar;

if(isset($_GET['act']))
{
	if($_GET['act']== 'register')
	{
		$body = require("register.php");
	}
	if($_GET['act']== 'help')
	{
		$body = "INSERT HELP PAGE";
	//$body = require("help.php");
	}
		if($_GET['act']== 'groups')
	{
		//$body = require("groups.php");
	}
		if($_GET['act']== 'login')
	{
		$body = require("login_inline.php");
	}

		if($_GET['act']== 'home')
	{
		$body = require("month.php");
	}
		if($_GET['act']== 'forgot')
	{
		$body = require("forgot.php");
	}
	if($_GET['act']== 'month')
	{
		$body = require("month.php");
	}
	if($_GET['act']== 'year')
	{
		$body = require("year.php");
	}
	if($_GET['act']== 'day')
	{
		//$body = require("day.php");
	}
		if($_GET['act']== 'messages')
	{
	//body = require("login_inline.php");
	}

}

?>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/bootstrap/js/docs.min.js"></script>
    <script var MenuBar1 = new Spry.Widget.MenuBar("sidebar", {imgRight:"../SidebarJavaScript/SpryMenuBarRightHover.gif"});>
  </body>
</html>