Group-K-Calendar
================
For MySQL information see the readme
titled mysql_table_info.txt under the
mysql /main/mysql

##################################################
             Function Documentation                    
##################################################

@@@@@@@@@@@@@@ CalendarFunctions.php @@@@@@@@@@@@@@@

####  draw_calendar($month,$year) return: $table
		This draws the big calendar that you see on the front page
		It returns a table that has all the data inside of it. It's
		two parameters are $month and $year. 
		  $month : two digit number eg. 04 = April
		  $year  : four digit number eg. 2014
	
####  draw_small_month($month,$year,$yflag) return: $table
		This draws the small month view that you see in the side bar,
		it is also used for the year view. Returns a table. Three parameters
		$month, $year, $yflag. $yflag controls whether or not it includes the
	    year next to the month on the first row. 
          $month : two digit number eg. 04 = April
		  $year  : four digit number eg. 2014
		  $yflag : 0 or 1, 1 to print year
		
####  draw_year($year) return: $table
		This draws the yearly view found on year.php It uses the 
		draw_small_month function to show the whole year. It only takes
		one parameter which is the current year the draw.
		  $year  : four digit number eg. 2014

####  draw_day($day,$month,$year) return: $table
		This draws the day view found on day.php It draws all
		hours inside a 24 hour period from the time you load the page.
		Has a parameter for day, month, and year
		  $day   : two digit number eg. 12
		  $month : two digit number eg. 04 = April
		  $year  : four digit number eg. 2014

####  month_convert($a) return: $a
		This takes in a month($a) and returns it's corresponding
		textual representation of month. $a can be any two digit
		number from 01 - 12.
		  $a     : two digit number eg. 01 = January

@@@@@@@@@@@@@@ CalendarJsFunctions.js @@@@@@@@@@@@@@

####  startTime() return: none
		This starts the clock that you find in the sidebar. It is run
		whenever index is first loaded. So it should always start based
		on the way the site is written.

####  checkTime(i) return: i
		This is a helper function to startTime(), it adds
		leading zeros to numbers that are less than 10, so 
		that the clock formats correctly.

		
