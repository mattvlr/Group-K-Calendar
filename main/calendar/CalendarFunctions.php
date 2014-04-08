<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] .'/main/mysql/_mysql.php');

	
	function draw_calendar($month,$year){ //I changed this lightly to color the current day -Matt
	
	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar" border="2">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();
	$todaymon = date("m");
	$todaynum = date("j"); 

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		
		    /* ADDED BY MATT AS A TEST */
			if($todaynum == $day_counter + 1):
				$calendar.= '<td class="today"><a class="no-link" href="/main/index.php?act=day&m='.$month.'&d='.$todaynum.'&y='.$year.'"></a>';
				$calendar.= '<div class="current-day">'.$list_day.'</div>';
				$calendar.= '<div class="event_box_no_event"></div>';
			else:
				$calendar.= '<td class="calendar-day"><a class="no-link" href="/main/index.php?act=day&m='.$month.'&d='.$list_day.'&y='.$year.'"></a>';
				/* add in the day number */
				$calendar.= '<div class="day-number">'.$list_day.'</div>';
				$calendar.= '<div class="event_box_no_event"></div>';
			endif;


			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
	}
	
	function draw_small_month($month,$year,$yflag){ //this is a trimed down version of draw_month -Matt
	    //&#8678;&#8680;
		$calendar = '<table cellpadding="0" cellspacing="0" class="calendar" >';
		$headings = array('Jan','Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Dec');
		$days = array('Su','M','Tu','W','Th','F','Sa');
		if($yflag == 1):
		$calendar.= '<th class="monthtitle" colspan="7">'.$headings[$month-1]." ".$year.'</th>';
		else:
		$calendar.= '<th class="monthtitle" colspan="7">'.$headings[$month-1].'</th>';
		endif;
		$calendar.= '<tr><th class="year-calendar-heading">'.implode('</th><th class="year-calendar-heading">',$days).'</th></tr>';
		$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
		$running_day = date('w',mktime(0,0,0,$month,1,$year));
		$days_in_this_week = 1;
		$day_counter = 0;
		$dates_array = array();
		$todaymon = date("m");
		$todaynum = date("j");
		$todayyear = date("Y");
		
			 
		/* row for week one */
		$calendar.= '<tr class="calendar-row">';

		/* print "blank" days until the first of the current week */
		for($x = 0; $x < $running_day; $x++):
			$calendar.= '<td class="year-calendar-np"> </td>';
			$days_in_this_week++;
		endfor;
     
		for($list_day = 1; $list_day <= $days_in_month; $list_day++): //days for each month loop
			
			if($list_day+$x == 1):
				$calendar.='<tr class="calendar-row">';
			endif;
			if((($list_day+$x-1) % 7) == 0):
				$calendar.='<tr class="calendar-row">';
			endif;
			
			if(($todaynum == $list_day) && ($todaymon == $month) && ($todayyear == $year)):
				$calendar.= '<td class="year-today"><a class="no-link" href="/main/index.php?act=day&m='.$month.'&d='.$list_day.'&y='.$year.'">'.$list_day.'</a>';
			else:
				$calendar.= '<td class="year-calendar-day"><a class="no-link" href="/main/index.php?act=day&m='.$month.'&d='.$list_day.'&y='.$year.'">'.$list_day.'</a>';
			endif;
			
			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			//$calendar.= str_repeat('<p> </p>',2);
			
			$calendar.= '</td>';
			$days_in_this_week = 0;
			$days_in_this_week++; $running_day++; /*$cur_day++;*/ $day_counter++;
		endfor;
		//$daysleft = (36-$cur_day-$x);
		//if(($month == 2) && ($days_in_month != 29)): //fuck Feb
		//$calendar.='<';
		//endif;
		//for($i = 1; $i < 38 - ($x + $days_in_month); $i++): //fills in empty boxes at bottom
		//		$calendar.='<td class="year-calendar-np"> </td>';
		//endfor;

			$calendar.='</tr>';
			$calendar.='</table>';
		return $calendar;
	}
	function draw_year($year){ //uses draw_small_month to show whole year -Matt
		$table = '<br><br>';
		$table.= '<table border="1px"><tr><th colspan="4" class="monthtitle">'.$year.'</td></tr>';
		
		$table.='<tr><td class="year-table">'.draw_small_month(1,$year,0).'</td><td class="year-table">'.draw_small_month(2,$year,0).'</td><td class="year-table">'.draw_small_month(3,$year,0).'</td><td class="year-table">'.draw_small_month(4,$year,0).'</td></tr>';
		
		$table.='<tr><td class="year-table">'.draw_small_month(5,$year,0).'</td><td class="year-table">'.draw_small_month(6,$year,0).'</td><td class="year-table">'.draw_small_month(7,$year,0).'</td><td class="year-table">'.draw_small_month(8,$year,0).'</td></tr>';
		
		$table.='<tr><td class="year-table">'.draw_small_month(9,$year,0).'</td><td class="year-table">'.draw_small_month(10,$year,0).'</td><td class="year-table">'.draw_small_month(11,$year,0).'</td><td class="year-table">'.draw_small_month(12,$year,0).'</td></tr>';
		
		
		$table.='</table>';
		return $table;
	}
	
	function draw_day($day,$month,$year){
		$mysql = new mysql_driver;
		$mysql->connect();
		
		$monthnum = $month;
		$month = month_convert($month);
		$hour = date('g');
		$minutes = date('i');
		$table = "";
		$table.= '<table class="day">';
		$table.= '<tr><th class="monthtitle" colspan="2">'.$month. " " . $day . " " . $year.'</th></tr>';
		
		$events = '';
		$start = $year . '-' . $monthnum . '-' . $day . ' 00:00:00';
		$events = $mysql->getEvents("NULL", $start, "day");
		$num_events = count($events);
		echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>-------------------------------------------------------------------------------------------------------------------------start : " . $start . "  num_events = ". $num_events;

		print_r($events);
		

		
		if(($hour >= 1) && ($hour <= 11)):
			$table.='<tr><th class="hourtitle">'.($hour).' pm</th><td class="day-event-content"></td></tr>';
			
			switch($minutes){
			case (($minutes >= 00) && ($minutes <= 20)):
				$table.='<tr><td class="current-minute">:15</td><td class="day-event-content"></td></tr>';
				$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
				$table.='<tr><td class="day-small-time">:45</td><td class="day-event-content"></td></tr>';
				break;
			case (($minutes > 20) && ($minutes <= 40)):
				$table.='<tr><td class="day-small-time">:15</td><td class="day-event-content"></td></tr>';
				$table.='<tr><td class="current-minute">:30</td><td class="day-event-content"></td></tr>';
				$table.='<tr><td class="day-small-time">:45</td><td class="day-event-content"></td></tr>';
				break;
			case (($minutes > 40) && ($minutes <= 59)):
				$table.='<tr><td class="day-small-time">:15</td><td class="day-event-content"></td></tr>';
				$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
				$table.='<tr><td class="current-minute">:45</td><td class="day-event-content"></td></tr>';
				break;
			default:
				break;
			}
		elseif(($hour >= 12) && ($hour <= 25)):
			$table.='<tr><th class="hourtitle">'.($hour).' am</th><td class="day-event-content"></td></tr>';
			
			switch($minutes){
			case (($minutes >= 00) && ($minutes <= 20)):
				$table.='<tr><td class="current-minute">:15</td><td class="day-event-content"></td></tr>';
				$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
				$table.='<tr><td class="day-small-time">:45</td><td class="day-event-content"></td></tr>';
				break;
			case (($minutes > 20) && ($minutes <= 40)):
				$table.='<tr><td class="day-small-time">:15</td><td class="day-event-content"></td></tr>';
				$table.='<tr><td class="current-minute">:30</td><td class="day-event-content"></td></tr>';
				$table.='<tr><td class="day-small-time">:45</td><td class="day-event-content"></td></tr>';
				break;
			case (($minutes > 40) && ($minutes <= 59)):
				$table.='<tr><td class="day-small-time">:15</td><td class="day-event-content"></td></tr>';
				$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
				$table.='<tr><td class="current-minute">:45</td><td class="day-event-content"></td></tr>';
				break;
			default:
				break;
			}
		endif;
		
		for($i = $hour + 1; $i < $hour+25; $i++):
				if(($i > 24) && ($i != 24)):
					$table.='<tr><th class="hourtitle">'.($i-24).' pm</th><td class="day-event-content"></td></tr>';
					$table.='<tr><td class="day-small-time">:15</td><td class="day-event-content"></td></tr>';
					$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
					$table.='<tr><td class="day-small-time">:45</td><td class="day-event-content"></td></tr>';
				elseif(($i > 12) && ($i != 12) && ($i != 24)):
						$table.='<tr><th class="hourtitle">'.($i-12).' am</th><td class="day-event-content"></td></tr>';
						$table.='<tr><td class="day-small-time">:15</td><td class="day-event-content"></td></tr>';
						$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
						$table.='<tr><td class="day-small-time">:45</td><td class="day-event-content"></td></tr>';
				elseif($i == 24):
						$table.='<tr><th class="hourtitle">'.($i - 12).' pm</th><td class="day-event-content"></td></tr>';
						$table.='<tr><td class="day-small-time">:15</td><td class="day-event-content"></td></tr>';
						$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
						$table.='<tr><td class="day-small-time">:45</td><td class="day-event-content"></td></tr>';
				elseif($i == 12):
						$table.='<tr><th class="hourtitle">'.(12).' am</th><td class="day-event-content"></td></tr>';
						$table.='<tr><td class="day-small-time">:15</td><td class="day-event-content"></td></tr>';
						$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
						$table.='<tr><td class="day-small-time">:45</td><td class="day-event-content"></td></tr>';
				elseif(($i != 12) && ($i != 24)):
						$table.='<tr><th class="hourtitle">'.$i.' pm</th><td class="day-event-content"></td></tr>';
						$table.='<tr><td class="day-small-time">:15</td><td class="day-event-content"></td></tr>';
						$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
						$table.='<tr><td class="day-small-time">:45</td><td class="day-event-content"></td></tr>';
				endif;
		endfor;
		$table.= '</table>';
		return $table;
	}
	function month_convert($a){ // purely for formatting
		switch($a){
		case ($a == "01"):
			$a = "January";
			break;
		case ($a == "02"):
			$a = "February";
			break;
		case ($a == "03"):
			$a = "March";
			break;
		case ($a == "04"):
			$a = "April";
			break;
		case ($a == "05"):
			$a = "May";
			break;
		case ($a == "06"):
			$a = "June";
			break;
		case ($a == "07"):
			$a = "July";
			break;
		case ($a == "08"):
			$a = "August";
			break;
		case ($a == "09"):
			$a = "September";
			break;
		case ($a == "10"):
			$a = "October";
			break;
		case ($a == "11"):
			$a = "November";
			break;
		case ($a == "12"):
			$a = "December";
			break;
		default:
			break;
		}
		return $a;
	}
	
	////////////////////////////////////////////////////////////////////By peter
//Function nav($day,$month, $year);  Takes in day month and year, returns
// the previous day month and year, and next day month and year
// Accounting for month and year changes
//If week view is added then this will need to be implemented here
// Also its possible that we just take in day and initialize month and year as the current
// to make them optional paramters.
///////////////////////////////////////////////////////////////////////
	function dayNav($day,$month,$year)
{

	//next and prev days +1 -1
	$pday = $day-1;
	$nday = $day+1;
	
	$pmonth = $month;
	$nmonth = $month;
	
	$pyear = $year;
	$nyear = $year;
	
	//Is the next day within the current month?
	if($nday > date('t', mktime(0,0,0,$month,1,$year))){
		$nmonth = $nmonth+1;
		$nday = 1;		
	}
	elseif($nday < 1)
	{
		$nmonth = $month-1;
		$nday = date('t', mktime(0,0,0,$month,1,$year));
	}
	//is the previous day within the current month?
	if($pday > date('t', mktime(0,0,0,$month,1,$year))){
		$pmonth = $month+1;
		$pday = 1;		
	}
	elseif($pday < 1)
	{
		$pmonth = $month-1;
		$pday = date('t', mktime(0,0,0,$month,1,$year));
	}
	
	//is the prev month within the current year
	if($pmonth < 1)
	{
		$pyear = $year - 1;
		$pmonth = 12;
	}
	elseif($pmonth > 12)
	{
		$pyear = $year + 1;
		$pmonth = 1;
	}
	//is the next month within the year
	if($nmonth < 1)
	{
		$nyear = $year - 1;
		$nmonth = 12;
	}
	elseif($nmonth > 12)
	{
		$nyear = $year + 1;
		$nmonth = 1;
	}
	
	//format data in assoc array and return it.
	$arr = array("pday" => $pday,"pmonth" => $pmonth,"pyear" => $pyear,"nday" => $nday,"nmonth" => $nmonth, "nyear" => $nyear);
	return $arr;
}
?>