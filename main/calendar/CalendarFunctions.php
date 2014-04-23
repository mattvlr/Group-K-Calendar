<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] .'/main/mysql/_mysql.php');

	function getMonthEventList($month,$year){
		$mysql = new mysql_driver;
		$mysql->connect();
		$events = '';
		$start = $year . '-' . $month . '-' . 1 . ' 00:00:00';
		$events = $mysql->getEvents("NULL", $start, "month", "asc");
		$num_events = count($events);
		$sid = $_SESSION['id'];
	
		$ec = 0; // number of events in the month for a user
		for($i = 0; $i < $num_events; $i++){
			if($sid == $events[$i]['ownerid']){
				$aday = substr($events[$i]['event_date'],8,2);
				$amonth = substr($events[$i]['event_date'],5,2);
				$ayear = substr($events[$i]['event_date'],0,4);
				$atime = substr($events[$i]['event_date'],11,5);
				$user_month_events[$ec] = array(
					$events[$i]['priority'],
					$events[$i]['date_created'],
					$aday, $amonth, $ayear, // a == array
					$events[$i]['repeat_style'],
					$events[$i]['repeat_until'],
					$events[$i]['title'],
					$events[$i]['description'],
					$atime,
					$events[$i]['location']
				);
			$ec++;
			}
		}
	return $user_month_events;
}
function getDayEventList($day,$month,$year){
		$mysql = new mysql_driver;
		$mysql->connect();
		$events = '';
		$start = $year . '-' . $month . '-' . $day . ' 00:00:00';
		$events = $mysql->getEvents("NULL", $start, "day", "asc");
		$num_events = count($events);
		$sid = $_SESSION['id'];
		$user_day_events = '';
		$ec = 0; // number of events in the day for a user
		for($i = 0; $i < $num_events; $i++){
			if($sid == $events[$i]['ownerid']){
				$aday = substr($events[$i]['event_date'],8,2);
				$amonth = substr($events[$i]['event_date'],5,2);
				$ayear = substr($events[$i]['event_date'],0,4);
				$atime = substr($events[$i]['event_date'],11,5);
				$user_day_events[$ec] = array(
					$events[$i]['priority'],
					$events[$i]['date_created'],
					$aday, $amonth, $ayear, // a == array
					$events[$i]['repeat_style'],
					$events[$i]['repeat_until'],
					$events[$i]['title'],
					$events[$i]['description'],
					$atime,
					$events[$i]['location']
				);
			$ec++;
			}
		}
	return $user_day_events;
}
function draw_calendar($month,$year){ //I changed this lightly to color the current day -Matt
		$user_month_events = getMonthEventList($month,$year);	
		echo "</div></center>";
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
	$hlist = getHolidayList($year);
	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;
	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		
		$combined_day = ($year."-".$month."-".$list_day);

		if($todaynum == $day_counter + 1):						
			$calendar.= '<td class="today"><a class="no-link" href="/main/index.php?act=day&m='.$month.'&d='.$todaynum.'&y='.$year.'"></a>';
			$calendar.= '<div class="current-day">'.$list_day.'</div>';
		else:	
			$calendar.= '<td class="calendar-day"><a class="no-link" href="/main/index.php?act=day&m='.$month.'&d='.$list_day.'&y='.$year.'"></a>';
			$calendar.= '<div class="day-number">'.$list_day.'</div>';		
		endif;
		
		for($i = 0; $i < count($hlist); $i++){
			if(($hlist[$i][2] == $month) && ($hlist[$i][1] == $list_day)){
				$calendar.= '<div class="event_box_h">'.$hlist[$i][0].'</div>';
			}
		}
		$event_day_counter = 0;
		$ec = count($user_month_events);
		for($i = 0; $i < $ec; $i++){ //goes through the event list and adds event divs for that day
			$event_date_test = ($user_month_events[$i][4]."-".$user_month_events[$i][3]."-".$user_month_events[$i][2]);
			if(($event_date_test == $combined_day) && ($event_day_counter <= 5)){	
				$calendar.= '<div class="event_box_'.$user_month_events[$i][0].'"><a class="event_no_link" href="/main/index.php?act=event&el[]='.
					$user_month_events[$i][0].'&el[]='.$user_month_events[$i][1].'&el[]='.$user_month_events[$i][2].'&el[]='.$user_month_events[$i][3].'
					&el[]='.$user_month_events[$i][4].'&el[]='.$user_month_events[$i][7].'&el[]='.$user_month_events[$i][8].'&el[]='.$user_month_events[$i][9].'&el[]='.
					$user_month_events[$i][10].'">'.$user_month_events[$i][7].' - '.$user_month_events[$i][9].'</a></div>';
				$event_day_counter++;
			}
		}
		
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
		$dayview = '';
		$monthview = '';
		$yearview ='';
		if(isset($_GET['d'])){
			 $dayview = $_GET['d'];
			 $monthview = $_GET['m'];
			 $yearview = $_GET['y'];
		}
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
			elseif(($list_day == $dayview) && ($month == $monthview) && ($year == $yearview)):
				$calendar.= '<td class="year-day-view"><a class="no-link" href="/main/index.php?act=day&m'.
				$month.'&d='.$list_day.'&y='.$year.'">'.$list_day.'</a>';
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
		$table.= '<center><table border="1px"><tr><th colspan="4" class="monthtitle">'.$year.'</td></tr>';
		
		$table.='<tr><td class="year-table">'.draw_small_month(1,$year,0).'</td><td class="year-table">'.draw_small_month(2,$year,0).'</td><td class="year-table">'.draw_small_month(3,$year,0).'</td><td class="year-table">'.draw_small_month(4,$year,0).'</td></tr>';
		
		$table.='<tr><td class="year-table">'.draw_small_month(5,$year,0).'</td><td class="year-table">'.draw_small_month(6,$year,0).'</td><td class="year-table">'.draw_small_month(7,$year,0).'</td><td class="year-table">'.draw_small_month(8,$year,0).'</td></tr>';
		
		$table.='<tr><td class="year-table">'.draw_small_month(9,$year,0).'</td><td class="year-table">'.draw_small_month(10,$year,0).'</td><td class="year-table">'.draw_small_month(11,$year,0).'</td><td class="year-table">'.draw_small_month(12,$year,0).'</td></tr>';
		
		
		$table.='</table></center>';
		return $table;
	}
	
	function draw_day($day,$month,$year){

		$monthnum = $month;
		$month = month_convert($month);
		$hour = date('g');
		$minutes = date('i');
	
		$table= "<br><br>";
		$table.= '<table class="day">';
		$table.= '<tr><th class="monthtitle" colspan="2">'.$month. " " . $day . " " . $year.'</th></tr>';
		$holidaylist = getHolidayList($year);
			for($i = 0; $i < count($holidaylist); $i++){
				if(($holidaylist[$i][1] == $day) && ($holidaylist[$i][2] == $monthnum)){
					$table.= '<tr><th class="hourtitle">All Day:</th><td><div class="day_event_box_h">'.$holidaylist[$i][0].'</div></td></tr>';
				}
			}
		
		$events = getDayEventList($day,$monthnum,$year);

		if($events != null){
			for($i = 0; $i < 24; $i++):
						if($i == 0):
								$table.='<tr><th class="hourtitle">'.(12).' am</th><td class="day-event-content">';
								for($j = 0; $j < count($events); $j++):
									$eHt = substr($events[$j][9],0,2); //event hour time
									$eMt = substr($events[$j][9],3,2);
									if(($i == $eHt) && ($eMt < 30) && ($day == $events[$j][2])){
										$table.='<div class="day_event_box_'.$events[$j][0].'">'.$events[$j][7].'</div>';
									}
								endfor;
								$table.='</td></tr>';
								$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content">';
								for($j = 0; $j < count($events); $j++):
									$eHt = substr($events[$j][9],0,2); //event hour time
									$eMt = substr($events[$j][9],3,2);
									if(($i == $eHt) && ($eMt >= 30) && ($day == $events[$j][2])){
										$table.='<div class="day_event_box_'.$events[$j][0].'">'.$events[$j][7].'</div>';
									}
								endfor;
								$table.='</td></tr>';
						elseif($i == 12):
								$table.='<tr><th class="hourtitle">'.(12).' pm</th><td class="day-event-content">';
								for($j = 0; $j < count($events); $j++):
									$eHt = substr($events[$j][9],0,2); //event hour time
									$eMt = substr($events[$j][9],3,2);
									if(($i == $eHt) && ($eMt < 30) && ($day == $events[$j][2])){
										$table.='<div class="day_event_box_'.$events[$j][0].'">'.$events[$j][7].'</div>';
									}
								endfor;
								$table.='</td></tr>';
								$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content">';
								for($j = 0; $j < count($events); $j++):
									$eHt = substr($events[$j][9],0,2); //event hour time
									$eMt = substr($events[$j][9],3,2);
									if(($i == $eHt) && ($eMt >= 30) && ($day == $events[$j][2])){
										$table.='<div class="day_event_box_'.$events[$j][0].'">'.$events[$j][7].'</div>';
									}
								endfor;
								$table.='</td></tr>';
						elseif(($i > 12)):
								$table.='<tr><th class="hourtitle">'.($i-12).' pm</th><td class="day-event-content">';
								for($j = 0; $j < count($events); $j++):
									$eHt = substr($events[$j][9],0,2); //event hour time
									$eMt = substr($events[$j][9],3,2);
									if(($i == $eHt) && ($eMt < 30) && ($day == $events[$j][2])){
										$table.='<div class="day_event_box_'.$events[$j][0].'">'.$events[$j][7].'</div>';
									}
								endfor;
								$table.='</td></tr>';
								$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content">';
								for($j = 0; $j < count($events); $j++):
									$eHt = substr($events[$j][9],0,2); //event hour time
									$eMt = substr($events[$j][9],3,2);
									if(($i == $eHt) && ($eMt >= 30) && ($day == $events[$j][2])){
										$table.='<div class="day_event_box_'.$events[$j][0].'">'.$events[$j][7].'</div>';
									}
								endfor;
								$table.='</td></tr>';
						elseif($i <= 12):
								$table.='<tr><th class="hourtitle">'.($i).' am</th><td class="day-event-content">';
								for($j = 0; $j < count($events); $j++):
									$eHt = substr($events[$j][9],0,2); //event hour time
									$eMt = substr($events[$j][9],3,2);
									if(($i == $eHt) && ($eMt < 30) && ($day == $events[$j][2])){
										$table.='<div class="day_event_box_'.$events[$j][0].'">'.$events[$j][7].'</div>';
									}
								endfor;
								$table.='</td></tr>';
								$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content">';
								for($j = 0; $j < count($events); $j++):
									$eHt = substr($events[$j][9],0,2); //event hour time
									$eMt = substr($events[$j][9],3,2);
									if(($i == $eHt) && ($eMt >= 30) && ($day == $events[$j][2])){
										$table.='<div class="day_event_box_'.$events[$j][0].'">'.$events[$j][7].'</div>';
									}
								endfor;
								$table.='</td></tr>';
						endif;
				endfor;
		}
		else{
		for($i = 0; $i < 24; $i++):
				if($i == 0):
					$table.='<tr><th class="hourtitle">'.(12).' am</th><td class="day-event-content"></td></tr>';
					$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
				elseif($i == 12):
					$table.='<tr><th class="hourtitle">'.(12).' pm</th><td class="day-event-content"></td></tr>';
					$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
				elseif(($i > 12)):
					$table.='<tr><th class="hourtitle">'.($i-12).' pm</th><td class="day-event-content"></td></tr>';
					$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
				elseif($i <= 12):
					$table.='<tr><th class="hourtitle">'.($i).' am</th><td class="day-event-content"></td></tr>';
					$table.='<tr><td class="day-small-time">:30</td><td class="day-event-content"></td></tr>';
				endif;
		endfor;
		}
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
	
function sidebarNav($month,$year)
	{

	//next and prev days +1 -1
	$pmonth = $month-1;
	$nmonth = $month+1;
	
	$pyear = $year;
	$nyear = $year;
	
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
	$arr = array("pmonth" => $pmonth,"pyear" => $pyear,"nmonth" => $nmonth, "nyear" => $nyear);
	return $arr;
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
function getHolidayDate($year,$holiday){//a lot of holidays fall for example on the 3rd Monday in February, this computes the correct
		             // day for a holiday. Returns a day for that holiday
		if($holiday == "MLK"):
		$string = 'January'.' '.$year.' '.'third monday';
		$day = date('d', strtotime($string));
		return $day;
		endif;
		
		if($holiday == "PRES"):
		$string = 'February'.' '.$year.' '.'third monday';
		$day = date('d', strtotime($string));
		return $day;
		endif;
		
		if($holiday == "MEM"):
		$string = 'May'.' '.$year.' '.'fourth monday';
		$day = date('d', strtotime($string));
		return $day;
		endif;
		
		if($holiday == "LAB"):
		$string = 'September'.' '.$year.' '.'first monday';
		$day = date('d', strtotime($string));
		return $day;
		endif;
		
		if($holiday == "COL"):
		$string = 'October'.' '.$year.' '.'second monday';
		$day = date('d', strtotime($string));
		return $day;
		endif;
		
		if($holiday == "THANK"):
		$string = 'November'.' '.$year.' '.'last monday';
		$day = date('d', strtotime($string));
		return $day;
		endif;
}
function getHolidayList($year){
	//Federal Holiday's
	$list[0] = array("New Year's Day",1,01);
	$list[1] = array("MLK Day",getHolidayDate($year,"MLK"),01);
	$list[2] = array("President's Day",getHolidayDate($year,"PRES"),02);
	$list[3] = array("Memorial Day",getHolidayDate($year,"MEM"),05);
	$list[4] = array("Independence Day",4,07);
	$list[5] = array("Labor Day",getHolidayDate($year,"LAB"),09); //broken, not sure why
	$list[6] = array("Columbus Day",getHolidayDate($year,"COL"),10);
	$list[7] = array("Veterans Day",11,11);
	$list[8] = array("Thanksgiving Day",getHolidayDate($year,"THANK"),11);
	$list[9] = array("Christmas Day",25,12);
	//Fun Other Holiday's
	$list[10] = array("New Year's Day",1,01);
	$list[11] = array("Groundhog Day",2,02);
	$list[12] = array("Valentine's Day",14,02);
	$list[13] = array("St. Patrick's Day",17,03);
	$list[14] = array("Cinco de Mayo",5,05);
	$list[15] = array("Mother's Day",11,05);
	$list[16] = array("Father's Day",15,06);
	$list[17] = array("Halloween",31,10);
    $list[18] = array("Test Holiday Day",25,04);
	$list[19] = array("Demo Day!!!!",29,04);
	return $list;
}

?>