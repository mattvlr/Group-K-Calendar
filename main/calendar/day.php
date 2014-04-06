<html>
<head>
<title>Day</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.js" type="text/javascript"></script>
</head>

<body>
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
			  <br>
			  <br>
			  <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Create Event</button>
			</ul>
            '. 	$draw . '
          </div>';
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New Event</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Create Event</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>