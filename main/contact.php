<?php

	$year = date('Y');
	$month = date('m');
	$day = date('j');
	$date = $year . '-' . $month . '-' . $day; // Date has to be formatted correctly 
	//$event_date = ''.$date." ".$time.':00';
	$time2 = date('H:i:s');
	$date2 = date('Y-m-d');

// if the form has been submitted and POST values set, then they can all be pushed to the database
if(isset($_POST['user_name']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['description'])){	
		
		$status = 'Form successfully submitted!';
		require_once('smtp/Send_Mail.php'); //email will be sent to self for now
					$email = "groupkscheduler@gmail.com";
					
					// What the email will include if form submission was successful
					$activation_email = 'You have successfully sent your inquiry. Thank you for your feedback!<br/><br/>
					<b>Inquiry Details:</b><br/><br/>
					User Name: '.$_POST['user_name'].'<br/>
					Date: '.$_POST['date'].'<br/>
					Time: '.$_POST['time'].'<br/>
					Description: '.$_POST['description'].'<br/><br/>';		
					Send_Mail($email,"User Inquiry",$activation_email);
}else{
		$status = 'Form not submitted!';
		require_once('smtp/Send_Mail.php'); //need to add a link back to the event from the email.
					$email = "groupkscheduler@gmail.com";
					$activation_email = 'The inquiry was not successfully sent. Please try again.<br/><br/>';					
					//Send_Mail($email, "User Inquiry Failed", $activation_email);
	}



$form = '	
<form class="form-signin" role="form" action="#" method = "post"><br>
			<b>Name:</b><input type="text" name = "user_name" class="form-control" placeholder="Your Name"><br>
			<b>Date:</b><input type="date" name="date" class="form-control" value="'.$date2.'"><br>
			<b>Time:</b><input type="time" name="time" class="form-control" value="'.$time2.'"><br>
			<b>Description:</b><textarea name="description" class="form-control" rows="3" id="textArea" placeholder="Question/Problem"></textarea><br>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button><br>
</form>';

?>

<html>
<head>
<link href="/bootstrap/css/dark_signin.css" rel="stylesheet">
</head>

<body><center><h1>Contact</h1></center>
<?php echo '<br/><br/>' ?>
<center><p>Have a question or experiencing a problem? Fill out the form below and let us know!</p></center>

<?php
echo $form;
?>
</div></body></html>
