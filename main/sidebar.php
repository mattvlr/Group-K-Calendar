<?php 
require_once('/calendar/CalendarFunctions.php');

if(isset($_SESSION['id']))
{
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
	//Generate views section
	$views= '<li '.$m.'><a href="?act=month">Month</a></li>
			 <li '.$y.'><a href="?act=year">Year Test</a></li>
			 <li '.$d.'><a href="?act=day">Day Test</a></li>';
		 
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
          <div id="sidebar-small-month">'. draw_small_month(date("m"),date("Y")) .'</div><div style="float:left;width:20px"><a id="loadleftmonth" href="#leftmonth">&#8592;</a></div><div style="float:right;"><a id="loadrightmonth" href="#rightmonth">&#8594;</a></div> 
		  <br>

		  Modal Test  <a href="/main/calendar/modaltest.php">Link</a>
		  </div>';
}
else    //Sidebar only for logged in users?
{
$sidebar = '';
}

echo $sidebar;
?>