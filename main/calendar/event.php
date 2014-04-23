<?php

		echo '<br><br>';
		$priority = $_GET['el'][0];
		$date_created = $_GET['el'][1];
		$day = $_GET['el'][2];
		//$month = month_convert($_GET['el'][3]);
		$month = $_GET['el'][3];
		$year = $_GET['el'][4];
		$title = $_GET['el'][5];
		$description = $_GET['el'][6];
		$time = $_GET['el'][7];
		$location = $_GET['el'][8];

$form = '	
<form class="form-signin" role="form" action="/main/index.php?act=day&m='. $month .'&d='. $day .'&y='. $year .'" method = "post"><br>
			<b>Event Title:</b><input type="text" name = "title" class="form-control" value="' . $title . '"><br>
			<b>Date:</b><input type="date" name = "date" class="form-control" value="' . $month . '/' . $day . '/' . $year . '"><br>
			<b>Time:</b><input type="time" name = "time" class="form-control" value="' . $time . '"><br>
			<b>Location:</b><input type="text" name = "location" class="form-control" value="' . $location . '"><br>
			<b>Description:</b><textarea class="form-control" rows="3" id="textArea">'.$description.'</textarea><br>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Save Changes</button><br>
</form>';

/*
$eventinfo2 = array(	'event_date' => $event_date,
		  				'title' => $_POST['title'],
		  				'location' => $_POST['location'],
		  				'description' => $_POST['description']
					);
						
//Putting stuff into database and making sure nothing went wrong
if($mysql->insert('events',$eventinfo2))
{
	$status = 'Event successfully modified!';
	require_once('smtp/Send_Mail.php'); //need to add a link back to the event from the email.
				$email = $mysql->select('user','email','id='.$eventinfo['ownerid']);
				$activation_email = 'You have changed the details of your event.<br/><br/>';					
				Send_Mail($email,"Event Details Modified",$activation_email);
}else{
	$status = 'Error occurred, event not added';
}
*/
?>

<html>
<head>
<link href="/bootstrap/css/dark_signin.css" rel="stylesheet">
</head>

<body><center><h1>Event Details</h1></center>
<?php
echo $form;
?>
</div></body></html>
