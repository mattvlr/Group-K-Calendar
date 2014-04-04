<?php //this is a trimed down version of draw_month -Matt
	    //&#8678;&#8680;
		$month = 5;
		$year = 2014;
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
	?>