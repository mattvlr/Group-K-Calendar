<?php 
	function draw_calendar($month,$year){ //I changed this lightly to color the current day -Matt

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

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
	$todaynum = date("d"); 

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
				$calendar.= '<td class="today" id="daybox" onclick=create_event('.$todaynum.','.$month.','.$year.') >';
				$calendar.= '<div class="current-day">'.$list_day.'</div>';
				$calendar.= '<div class="event_box_no_event"></div>';
			else:
				$calendar.= '<td class="calendar-day" id="daybox" onclick=create_event('.$list_day.','.$month.','.$year.') >';
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
	
	function draw_small_month($month,$year){ //this is a trimed down version of draw_month -Matt
	    //&#8678;&#8680;
		$calendar = '<table cellpadding="0" cellspacing="0" class="calendar" >';
		$headings = array('Jan','Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Dec');
		$days = array('Su','M','Tu','W','Th','F','Sa');

		$calendar.= '<th class="monthtitle" colspan="7">'.$headings[$month-1].'</th>';
		$calendar.= '<tr><th class="year-calendar-heading">'.implode('</th><th class="year-calendar-heading">',$days).'</th></tr>';
		$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
		$running_day = date('w',mktime(0,0,0,$month,1,$year));
		$days_in_this_week = 1;
		$day_counter = 0;
		$dates_array = array();
		$todaymon = date("m");
		$todaynum = date("d");
		
			 
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
			
			if(($todaynum == $list_day) && ($todaymon == $month)):
				$calendar.= '<td class="year-today">'.$list_day;
			else:
				$calendar.= '<td class="year-calendar-day" id="daybox">'.$list_day;
			endif;
			
			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
			
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
		
		$table.= '<table border="1px"><tr><th colspan="4" class="monthtitle">'.$year.'</td></tr>';
		
		$table.='<tr><td class="year-table">'.draw_small_month(1,$year).'</td><td class="year-table">'.draw_small_month(2,$year).'</td><td class="year-table">'.draw_small_month(3,$year).'</td><td class="year-table">'.draw_small_month(4,$year).'</td></tr>';
		
		$table.='<tr><td class="year-table">'.draw_small_month(5,$year).'</td><td class="year-table">'.draw_small_month(6,$year).'</td><td class="year-table">'.draw_small_month(7,$year).'</td><td class="year-table">'.draw_small_month(8,$year).'</td></tr>';
		
		$table.='<tr><td class="year-table">'.draw_small_month(9,$year).'</td><td class="year-table">'.draw_small_month(10,$year).'</td><td class="year-table">'.draw_small_month(11,$year).'</td><td class="year-table">'.draw_small_month(12,$year).'</td></tr>';
		
		
		$table.='</table>';
		return $table;
	
	}
	
	function draw_day($day){
		$hour = date('h');
		$table.= '<table class="day" align="center">';
		$table.= '<tr><th>'.date("F"). " " . date("d") . " " . date("Y"). '</th><th>Current Time: <div id="txt"></div></th></tr>';
		for($i = $hour; $i < 24; $i++):
			if($i > 24):
				$table.='<tr><td>'.($i-24).'</td></tr>';
				$table.='<tr><td class="day-small-time">:15</td></tr>';
				$table.='<tr><td class="day-small-time">:30</td></tr>';
				$table.='<tr><td class="day-small-time">:45</td></tr>';
			else:
					$table.='<tr><td>'.$i.'</td></tr>';
					$table.='<tr><td class="day-small-time">:15</td></tr>';
					$table.='<tr><td class="day-small-time">:30</td></tr>';
					$table.='<tr><td class="day-small-time">:45</td></tr>';
			endif;
		endfor;
		$table.= '</table>';
		return $table;
	}
?>