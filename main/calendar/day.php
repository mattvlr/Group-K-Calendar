<html>
<head>
<title>Day</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.js" type="text/javascript"></script>

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
else if ($_POST['repeatstyle'] == 'weekly'){$repeat_style = 'week'; $repeat_until = $_POST['repeatuntil'];}
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
if($mysql->insert('events',$eventinfo))
{
	$status = 'Event Successfully added!!';
	require_once('smtp/Send_Mail.php'); //need to add a link back to the event from the email.
				$email = $mysql->select('user','email','id='.$eventinfo['ownerid']);
				$activation_email = 'You have added an event to your calendar.<br/><br/>';					
				Send_Mail($email,"Event Added",$activation_email);

}
else
{
	$status = 'Error occurred, event not added';
}
}

echo '
			 <div style="position:absolute; left:260px; width:1650px;"><div style="position:fixed; left:515px; top: 50px z-index:4;">
			  <ul class="pager">
			  <li><a href="/main/index.php?act=day&m='. $nav['pmonth'] .'&d='. $nav['pday'] .'&y='. $nav['pyear'] .'">Yesterday</a></li>
			  <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Create Event</button>
			  <li><a href="/main/index.php?act=day&m='. $nav['nmonth'] .'&d='. $nav['nday'] .'&y='. $nav['nyear'].'">Tomorrow</a></li>
			  </ul></div>
			  '.$draw.'</div>';

if (!isset($status)){echo '';}
else {echo ''.$status.'';}

//Tha form
$body = '<div class="eventcreation">
	<form class="form-signin" role="form" action="/main/index.php?act=day&m='. $month .'&d='. $day .'&y='. $year .'" method = "post">
	<center><h1>Create your event!</h1></center>
	<input type="text" name = "title" class="form-control" placeholder="Event Title" required autofocus>
	<input type="text" name = "location" class="form-control" placeholder="Location" required><br>
	<center><b>Event Date :</b></center><input type="date" name = "date" class="form-control" required>
	<center><b>Event Time :</b></center><input type="time" name = "time" class="form-control" required>
	<center><b>Priority</b></center>
	<center><input type="radio" name="priority" value="1" checked="">Low
	<input type="radio" name="priority" value="2">Medium
	<input type="radio" name="priority" value="3">High</center><br>
	
	<center><b>Repeat Event?</b></center>
	<center><input type="radio" name="repeat" value="yes">Yes
	<input type="radio" name="repeat" value="no" checked ="">No</center><br>
	
	<center><b>Repeat Style</b></center>
	<center><input type="radio" name="repeatstyle" value="daily">Daily
	<input type="radio" name="repeatstyle" value="weekly">Weekly
	<input type="radio" name="repeatstyle" value="monthly">Monthly	
	<input type="radio" name="repeatstyle" value="none" checked="">None</center><br>
	<center><b>Repeat Until :</b></center><input type="date" name = "repeatuntil" class="form-control" required>
	
	<textarea class="form-control" rows="5" name="description" placeholder="description of event" required></textarea><br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
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
		
		<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>

</html>