
<?php 
require_once('/calendar/CalendarFunctions.php');

if(isset($_SESSION['id']))
{
	//highlight the currently selected view
	
	$today = date("Y-m-d H:i:s");
	$events = $mysql->getEvents( "NULL", $today ,"day");
	$num_events = count($events);
	
	
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
	$views = "";
	$sidebar = "";
	$views= '<li '.$d.'><a href="?act=day&m='.date("m")."&d=" . date("d") . "&y=" . date("Y").'">Today</a></li>
			 <li '.$m.'><a href="?act=month">Month</a></li>
			 <li '.$y.'><a href="?act=year">Year</a></li>';
		 
	$sidebar .= '
        <div class="col-sm-4 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
			<li class="list-group-item">
              <span class="badge"><div id="time"></div></span>
                Current Time:</li>
            <li class="list-group-item">
              <span class="badge">14</span>
                <a href="index.php?act=pm">Messages</a></li>
            <li class="list-group-item">
               <span class="badge">'. $num_events .'</span>
                <a href="index.php?act=upcoming">Upcoming Events<a></li>
            <li><a href="act=groups">Groups</a></li>
          </ul>
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
	$acts = $_GET['act']; 
	
	
		if(isset($_GET['tar'])){
			if($_GET['tar'] == 'f'){
			$mc++;
			if($mc > 12):
				$mc = 1;		
				$yc++;
			endif;
			}
			elseif($_GET['tar'] == 'b'){
			$mc--;
			if($mc < 1):
				$mc = 12;
				$yc--;
			endif;
			}
		}
		$drawsc = draw_small_month($mc,$yc,1);
		
		$sidebar .= '<div id="sidebar-small-month">'. $drawsc.'</div>
			 <div id="left" style="float:left;width:20px">
			 <a href="?act='.$acts.'&month='.$mc.'&year='.$yc.'&tar=b">&#8592;(prev)</a></div>
			 <div id="right" style="float:right">
			 <a href="?act='.$acts.'&month='.$mc.'&year='.$yc.'&tar=f">(next)&#8594;</a></div>
		
				<br>
		 	 	<br>
				<!--AJAX Test <a href="/main/calendar/ajaxtest.php">Link</a><br>
				Modal Test  <a href="/main/calendar/modaltest.php">Link</a><br>
				-->
				</div>';

}
else    //Sidebar only for logged in users?
{
$sidebar = '';
}
echo $sidebar;
?>