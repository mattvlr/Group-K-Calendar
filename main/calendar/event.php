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
<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '?act=login" method = "post"><br>
			<b>Event Title:</b><input type="text" name = "title" class="form-control" value="' . $title . '"><br>
			<b>Date:</b><input type="text" name = "date" class="form-control" value="' . $month . '/' . $day . '/' . $year . '"><br>
			<b>Time:</b><input type="time" name = "time" class="form-control" value="' . $time . '"><br>
			<b>Location:</b><input type="text" name = "location" class="form-control" value="' . $location . '"><br>
			<b>Description:</b><textarea class="form-control" rows="3" id="textArea">'.$description.'</textarea><br>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Save Changes</button><br>
</form>';
		
?>

<html>
<head>
<link href="/bootstrap/css/dashboard.css" rel="stylesheet">
<link href="/bootstrap/css/signin.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="template.css">
</head>

<body><center><h1>Event Details</h1></center>
<?php
echo $form;
?>
</div></body></html>
