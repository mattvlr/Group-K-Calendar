<?php

		echo '<br><br>';
		//$priority = $_GET['el'][0];
		//$date_created = $_GET['el'][1];
		//$month2 = month_convert($_GET['el'][3]);
		
		$day = $_GET['el'][2];
		$month = $_GET['el'][3];
		$year = $_GET['el'][4];
		$title = $_GET['el'][5];
		$description = $_GET['el'][6];
		$time = $_GET['el'][7];
		$location = $_GET['el'][8];
		$eid = $_GET['el'][9]; // Event ID
		$date = $year . '-' . $month . '-' . $day; // Date has to be formatted correctly 
		$event_date = ''.$date." ".$time.':00';

// if the form has been submitted and POST values set, then they can all be pushed to the database
if(isset($_POST['title2']) && isset($_POST['location2']) && isset($_POST['date2']) && isset($_POST['time2']) && isset($_POST['description2'])){	
		
	//Putting stuff into database and making sure nothing went wrong
	if($mysql->update('events', 'title="'.$_POST['title2'].'" , event_date="'.$event_date.'" , location="'.$_POST['location2'].'" , description="'.$_POST['description2'].'"', 'eid="'.$eid.'"'))
	{
		$status = 'Event successfully modified!';
		require_once('smtp/Send_Mail.php'); //need to add a link back to the event from the email.
					$email = $mysql->select('user','email','id='.$_SESSION['id']);
					
					// What the email will include if event modification was successful
					$activation_email = 'You have changed the details of your event.<br/><br/>
					<b>Event Details:</b><br/><br/>
					Title: '.$_POST['title2'].'<br/>
					Date: '.$_POST['date2'].'<br/>
					Time: '.$_POST['time2'].'<br/>
					Location: '.$_POST['location2'].'<br/>
					Description: '.$_POST['description2'].'<br/><br/>';		
					Send_Mail($email,"Event Details Modified",$activation_email);
	}else{
		$status = 'Event modification failed!';
		require_once('smtp/Send_Mail.php'); //need to add a link back to the event from the email.
					$email = $mysql->select('user','email','id='.$_SESSION['id']);
					$activation_email = 'Event details could not be modified.<br/><br/>';					
					Send_Mail($email, "Event Details Not Modified", $activation_email);
	}
}

// What the event modification form will look like
$form = '	
<form class="form-signin" role="form" action="#" method = "post"><br>
			<b>Event Title:</b><input type="text" name = "title2" class="form-control" value="' . $title . '"><br>
			<b>Date:</b><input type="date" name="date2" class="form-control" value="' . $date . '"><br>
			<b>Time:</b><input type="time" name="time2" class="form-control" value="' . $time . '"><br>
			<b>Location:</b><input type="text" name="location2" class="form-control" value="' . $location . '"><br>
			<b>Description:</b><textarea name="description2" class="form-control" rows="3" id="textArea">'.$description.'</textarea><br>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Save Changes</button><br>
</form>';

?>

<html>
<head>
<link href="/bootstrap/css/dark_signin.css" rel="stylesheet">
</head>

<body><center><h1>Event Details</h1></center>
<?php
echo $form;
?>
</body></html>
