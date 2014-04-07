<title>Day</title>

<?php
	require_once('CalendarFunctions.php');

	if(!isset($_GET['y'])){
			$year = date('Y');
	}
	else{
			$year = $_GET['y'];
	}
	if(!isset($_GET['m'])){
			$month = date('m');
	}
	else{
			$month = $_GET['m'];
	}
	if(!isset($_GET['d'])){
			$day = date('d');
	}
	else{
			$day = $_GET['d'];
	}
	$draw = draw_day($day,$month,$year);
	$pday = $day-1;
	$nday = $day+1;
	
	$pmonth = $month;
	$nmonth = $month;
	
	$pyear = $year;
	$nyear = $year;
	
	if($nday > date('t', mktime(0,0,0,$month,1,$year))){
		$nmonth = $nmonth+1;
		$nday = 1;		
	}
	elseif($nday < 1)
	{
		$nmonth = $month-1;
		$nday = date('t', mktime(0,0,0,$month,1,$year));
	}
	
	if($pday > date('t', mktime(0,0,0,$month,1,$year))){
		$pmonth = $month+1;
		$pday = 1;		
	}
	elseif($pday < 1)
	{
		$pmonth = $month-1;
		$pday = date('t', mktime(0,0,0,$month,1,$year));
	}
	
	if($pmonth < 1)
	{
		$pyear = $year - 1;
		$pmonth = 12;
	}
	elseif($pmonth > 12)
	{
		$pyear = $year + 1;
		$pmonth = 1;
	}
	
	if($nmonth < 1)
	{
		$nyear = $year - 1;
		$nmonth = 12;
	}
	elseif($nmonth > 12)
	{
		$nyear = $year + 1;
		$nmonth = 1;
	}
	
	
	

	

echo '
			<center><ul class="pager" style="width: 200px; height: 100px; display:block;">
			  <li><a href="/main/index.php?act=day&m='. $pmonth .'&d='. $pday .'&y='. $pyear .'">Yesterday</a></li>
			  <li><a href="/main/index.php?act=day&m='. $nmonth .'&d='. $nday .'&y='. $nyear .'">Tomorrow</a></li>
			</ul></center>
            '. 	$draw .'';
?>
</html>