<?php 
require_once('/calendar/CalendarFunctions.php');

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
$sidebar = '';
}

echo $sidebar;
?>