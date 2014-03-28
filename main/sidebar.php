<?php 
require_once('/calendar/CalendarFunctions.php');

//highlight the currently selected view
$m = '';
$y = '';
$d = '';

if(isset($_GET['act']) && $_GET['act'] == 'year')
{
$y = 'class="active"';
}
else if(isset($_GET['act']) && $_GET['act'] == 'day')
{
$d = 'class="active"';
}
else if(isset($_GET['act']) && $_GET['act'] == 'month')
{
$m = 'class="active"';
}

$views= '<li '.$m.'><a href="?act=month">Month</a></li>
         <li '.$y.'><a href="?act=year">Year Test</a></li>
         <li '.$d.'><a href="?act=day">Day Test</a></li>';

if(isset($_SESSION['id']))
{
	$sidebar = '<div class="container-fluid">
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
		'.$views.'
          </ul>
          '. draw_small_month(date("m"),date("Y")) .'
          <br>
          Check out the login form <a href="login.php">here.</a>
		  </div>';
}
else
{
$sidebar = '';
}

echo $sidebar;
?>