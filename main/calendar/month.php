<title>Month</title>
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

	$nav = monthNav($month,$year); 

	$monthword = month_convert($month);

echo '<center><div style=" position:absolute; left:260px; top:101px; height:100%;">
            <div class="btn-group btn-group-justified" style="position:fixed; top:58px;width:77%;z-index:2;">
			  <a href="/main/index.php?act=month&m='. $nav['pmonth'] .'&y='. $nav['pyear'] .'" class="btn btn-default">« Previous Month</a>
			  <a href="#" class="btn btn-default">'. $monthword . " " . $year . '</a>
			  <a href="/main/index.php?act=month&m='. $nav['nmonth'] .'&y='. $nav['nyear'] .'" class="btn btn-default">Next Month »</a>
			</div>
            '. draw_calendar($month, $year) . '
   	 </div></center>';

?>
