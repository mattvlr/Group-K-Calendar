<html>
<head>
<title>Day</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
</head>

<body>

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
			$day = date('j');
	}
	else{
			$day = $_GET['d'];
	}
	
	$draw = draw_day($day,$month,$year);  // draw calendar
	$nav = dayNav($day,$month,$year);  //generate navigation

//Stuff that happens after event is submitted	
if( isset($_POST['title']) && isset($_POST['location']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['description']) && isset($_POST['repeatuntil'])){

//Formatting stuff to be sent to database
$repeat_style = '';
$repeat_until = '';
$date = date("Y-m-d");
if ($_POST['repeat'] == 'no'){$repeat_style = 'none'; $repeat_until = $_POST['date'];}
else if ($_POST['repeatstyle'] == 'daily') {$repeat_style = 'day'; $repeat_until = $_POST['repeatuntil'];}
else if ($_POST['repeatstyle'] == 'monthly'){$repeat_style = 'month'; $repeat_until = $_POST['repeatuntil'];}
$gid = '1';
$event_date = ''.$_POST['date']." ".$_POST['time'].':00';

$eventinfo = array(		'gid' => $gid,
						'ownerid' => $id,
						'priority' => $_POST['priority'],
		  				'date_created' => $date,
		  				'event_date' => $event_date,
		  				'repeat_style' => $repeat_style,
		  				'repeat_until' => $repeat_until,
		  				'title' => $_POST['title'],
		  				'location' => $_POST['location'],
		  				'description' => $_POST['description']
					);

//Putting stuff into database and making sure nothing went wrong
	if($eventinfo['repeat_style'] == 'none'){
		if($mysql->insert('events',$eventinfo)){
			$status = 'Event Successfully added!!';
			require_once('smtp/Send_Mail.php'); //need to add a link back to the event from the email.
						$email = $mysql->select('user','email','id='.$eventinfo['ownerid']);
						$activation_email = 'You have added an event to your calendar.<br/><br/>';					
						Send_Mail($email,"Event Added",$activation_email);

		}
		else{
			$status = 'Error occurred, event not added';
		}
	}
	elseif($eventinfo['repeat_style'] == 'day'){
		//getting conditions to check against in loop
		$day = substr($eventinfo['event_date'],8,2);
		$month = substr($eventinfo['event_date'],5,2);
		$year = substr($eventinfo['event_date'],0,4);
		$time = substr($eventinfo['event_date'],11,8);
		
		$end_day = substr($eventinfo['repeat_until'],8,2);
		$end_month = substr($eventinfo['repeat_until'],5,2);
		$end_year = substr($eventinfo['repeat_until'],0,4);
		$flag = 0;
		
		$first = strtotime($year.'-'.$month.'-'.$day);
		$second = strtotime($end_year.'-'.$end_month.'-'.$end_day);
		$datediff = abs($first - $second);
		$num_of_days = floor($datediff/(60*60*24));
		
		for($i = 0; $i <= $num_of_days; $i++){
			$eventinfo['event_date'] = ($year."-".$month."-".$day." ".$time); //update the event date
			if($mysql->insert('events',$eventinfo)){
				$status = 'Event Successfully added!!';
				if($flag == 0){
				require_once('smtp/Send_Mail.php'); //need to add a link back to the event from the email.
						$email = $mysql->select('user','email','id='.$eventinfo['ownerid']);
						$activation_email = 'You have added an event to your calendar. This event will not repeat.<br/><br/>
						<b>Event Details:</b><br/><br/>
						Title: '.$_POST['title'].'<br/>
						Date: '.$_POST['date'].'<br/>
						Time: '.$_POST['time'].'<br/>
						Location: '.$_POST['location'].'<br/>
						Description: '.$_POST['description'].'<br/><br/>
						To change any of these event details, please click <a href="#">here</a>.';					
						Send_Mail($email,"Event Added",$activation_email);
						$flag = 1;
				}
			}
			else{
				$status = 'Error occurred, event not added';
			}
			$day++;
			$days_left_in_month = date('t',mktime(0,0,0,$month,1,$year));
			if($day > $days_left_in_month){
				$day = 1;
				$month++;
			}
			if($month > 12){
				$month = 1;
				$year++;
			}
		}
	}
	elseif($eventinfo['repeat_style'] == 'month'){ //works!!!
		$day = substr($eventinfo['event_date'],8,2);
		$month = substr($eventinfo['event_date'],5,2);
		$year = substr($eventinfo['event_date'],0,4);
		$time = substr($eventinfo['event_date'],11,8);
		
		$end_month = substr($eventinfo['repeat_until'],5,2);
		$end_year = substr($eventinfo['repeat_until'],0,4);
		$num_of_months = ($end_year-$year) * 12 + ($end_month-$month);
		$flag = 0;
		for($i = 0; $i <= $num_of_months; $i++){
		$eventinfo['event_date'] = ($year."-".$month."-".$day." ".$time); //update the event date
			if($mysql->insert('events',$eventinfo)){
				$status = 'Event Successfully added!!';
				if($flag == 0){
				require_once('smtp/Send_Mail.php'); //need to add a link back to the event from the email.
						$email = $mysql->select('user','email','id='.$eventinfo['ownerid']);
						$activation_email = 'You have added an event to your calendar. This event will repeat monthly.<br/><br/>
						<b>Event Details:</b><br/><br/>
						Title: '.$_POST['title'].'<br/>
						Date: '.$_POST['date'].'<br/>
						Time: '.$_POST['time'].'<br/>
						Location: '.$_POST['location'].'<br/>
						Description: '.$_POST['description'].'<br/><br/>
						To change any of these event details, please click <a href="#">here</a>.';					
						Send_Mail($email,"Event Added",$activation_email);
						$flag = 1;}
			}
			else{
				$status = 'Error occurred, event not added';
			}
			$month++;
			if($month > 12){
				$month = 1;
				$year++;
			}	
		}
	}
	
}

echo '
			<div class="btn-group btn-group-justified" style="width:100%;padding-left:260px;top:58px;position:fixed; z-index:2;">
			  <a href="/main/index.php?act=day&m='. $nav['pmonth'] .'&d='. $nav['pday'] .'&y='. $nav['pyear'] .'" class="btn btn-default">« Yesterday</a>
			  <a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal">Create Event</a>
			  <a href="/main/index.php?act=day&m='. $nav['nmonth'] .'&d='. $nav['nday'] .'&y='. $nav['nyear'].'" class="btn btn-default">Tomorrow »</a>
			</div>



			 <div class="day_content" style="position:absolute; top:12px;left:260px; width:110%;">
			  '.$draw.'</div>';

if (!isset($status)){echo '';}
else {echo ''.$status.'';}

//Tha form
$body = '<div class="eventcreation">
	<form class="form-signin" role="form" action="/main/index.php?act=day&m='. $month .'&d='. $day .'&y='. $year .'" method = "post">
	

	<b>Title</b><input type="text" name = "title" class="form-control" required autofocus>
	<b>Location</b><input type="text" name = "location" class="form-control"required>
	<b>Date</b><input type="date" name ="date" class="form-control" required>
	<b>Time</b><input type="time" name ="time" class="form-control" required>


	<b>Description</b><textarea class="form-control" rows="5" name="description" required></textarea>

	<center><b>Priority</b></center>
	<center><input type="radio" name="priority" value="1" checked="">Low
	<input type="radio" name="priority" value="2">Medium
	<input type="radio" name="priority" value="3">High</center><br>
	
	<center><b>Repeat Event?</b></center>
	<center><input type="radio" name="repeat" value="yes" id="repeatyes" onclick="javascript:yesnoCheck();">Yes
	<input type="radio" name="repeat" value="no" checked ="yes" id="repeatno" onclick="javascript:yesnoCheck();">No</center><br>
	
	<center><b>Repeat Style</b></center>
	<center><input type="radio" name="repeatstyle" value="daily">Daily
	<input type="radio" name="repeatstyle" value="monthly">Monthly	
	<input type="radio" name="repeatstyle" value="none" checked="">None</center><br>
	<center><b>Repeat Until :</b></center><input type="date" name = "repeatuntil" class="form-control" required>

	<div class="modal-footer">
		<button class="btn btn-primary" type="submit">Create</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
	</form>
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
	    
	    <?php
		echo ''.$body.'';
		?>
    </div>
  </div>
</div>
</body>
</html>