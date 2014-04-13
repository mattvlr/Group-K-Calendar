<?php
	//print_r($_GET);
	$month = $_GET['month'];
	$year = $_GET['year'];
	include('CalendarFunctions.php');
	echo draw_small_month($month,$year,1);
?>