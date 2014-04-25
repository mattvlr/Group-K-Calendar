
<script src="/bootstrap/js/bootstrap.js" type="text/javascript"></script>

<?php 

//require_once('/Applications/XAMPP/xamppfiles/htdocs/main/calendar/CalendarFunctions.php');
require_once('/calendar/CalendarFunctions.php');

if(isset($_SESSION['id']))
{
	//highlight the currently selected view
	
	$today = date("Y-m-d H:i:s");
	$events = $mysql->getEvents( "NULL", $today, 3 ,'asc');

	if($events != false)
	{
	$num_events = count($events);
	}
	else
	{
	$num_events = 0;
	}

	$m = '';
	$y = '';
	$d = '';

	$dash = '';

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

	if(isset($_GET['act']) && $_GET['act'] == 'pm')
	{
	$dash = 'class="active"';
	}
	else if(isset($_GET['act']) && $_GET['act'] == 'upcoming')
	{
	$dash = 'class="active"';
	}
	else if(isset($_GET['act']) && $_GET['act'] == 'groups')
	{
	$dash = 'class="active"';
	}

	//Generate views section
	$views = "";
	$sidebar = "";
	$views= '<li '.$d.'><a href="?act=day&m='.date("m")."&d=" . date("d") . "&y=" . date("Y").'">Today</a></li>
			 <li '.$m.'><a href="?act=month">Month</a></li>
			 <li '.$y.'><a href="?act=year">Year</a></li>';
		 
	$sidebar .= '
 	<div class="col-sm-4 col-md-2 sidebar" style="position:fixed; top:40px">
          <ul class="nav nav-sidebar">
		'.$views.'</ul>';
		
	if(!isset($_GET['y'])){
			$yc = date('Y');
	}
	else{
			$yc = $_GET['y'];
	}
	if(!isset($_GET['m'])){
			$mc = date('m');
	}
	else{
			$mc = $_GET['m'];
	}
	if(!isset($_GET['d'])){
			$dc = date('d');
	}
	else{
			$dc = $_GET['d'];
	}
	$acts = $_GET['act']; 
		
		$drawsc = draw_small_month($mc,$yc,1);
		$nav = sidebarNav($mc,$yc);
		$sidebar .= '<div style="position:fixed;top:280px;"><div id="sidebar-small-month">'. $drawsc.'</div>
			 <div id="left" style="float:left;width:20px">
			 <a href="?act='.$acts.'&m='.$nav['pmonth'].'&y='.$nav['pyear'].'">&#8592;(prev)</a></div>
			 <div id="right" style="float:right">
			 <a href="?act='.$acts.'&m='.$nav['nmonth'].'&y='.$nav['nyear'].'">(next)&#8594;</a></div>
				</div>
			</div>';

}
else    //Sidebar only for logged in users?
{
$sidebar = '';
}
echo $sidebar;
?>