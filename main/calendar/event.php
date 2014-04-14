<title>Event</title><br><br><br>
<center><div style="text-align: center; width:50%;"> This is my poorly designed event page
if someone wants to clean it up, please do. Also I left out location on accident. -Matt <br>
<?php
		print_r($_GET); // comment out
		$priority = $_GET['el'][0];
		$date_created = $_GET['el'][1];
		$day = $_GET['el'][2];
		$month = month_convert($_GET['el'][3]);
		$year = $_GET['el'][4];
		$title = $_GET['el'][5];
		$description = $_GET['el'][6];
		$time = $_GET['el'][7];

		echo '<br><br><h1>'.$title.'</h1>';
		echo 'Event Date: '. $month .' '. $day .' '. $year .' at '. $time;
		echo '<p>Description: '. $description .' </p>';
?>
</div></center>