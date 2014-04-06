<title>Day</title>

<?php
	require_once('CalendarFunctions.php');
	$day = $_GET['d'];
	$month = $_GET['m'];
	$year = $_GET['y'];

	$cmdays = date('t', mktime(0,0,0,$month,1,$year));

	if(isset($_GET['tar'])){
		if($_GET['tar'] == 'f'){
			$day++;
			$draw = draw_day($day-1,$month,$year);
			if($day > $cmdays):
				//$month = $month+1;
				$day = 1;		
				//$day++;
			endif;
			}
			elseif($_GET['tar'] == 'b'){
			$day--;
			$draw = draw_day($day+1,$month,$year);
			if($day < 1):
				$month = $month-1;
				$day = date('t', mktime(0,0,0,$month-1,1,$year));
				// 	$day=;
			endif;
			}
		}

echo '<div class="day">
			<ul class="pager">
			  <li><a href="/main/index.php?act=day&m='. $month .'&d='. $day .'&y='. $year .'&tar=b">Yesterday</a></li>
			  <li><a href="/main/index.php?act=day&m='. $month .'&d='. $day .'&y='. $year .'&tar=f">Tomorrow</a></li>
			</ul>
            '. 	$draw . '
          </div>';
?>
</html>