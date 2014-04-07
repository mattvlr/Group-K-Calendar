<html>
<head>
<title>Day</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.js" type="text/javascript"></script>

</head>

<body>

<?php
	require_once('CalendarFunctions.php');

	if(!isset($_GET['y'])){
			$year = date('Y');
	}
	else{
			$year = $_GET['y'];
	}
	if(!isset($_GET['m'])){
			$month = date('m');
	}
	else{
			$month = $_GET['m'];
	}
	if(!isset($_GET['d'])){
			$day = date('d');
	}
	else{
			$day = $_GET['d'];
	}
	
	$draw = draw_day($day,$month,$year);  // draw calendar
	$nav = dayNav($day,$month,$year);  //generate navigation

echo '
			<div style="padding-left:48%;"><ul class="pager" style="width: 300px; height: 100px; display:block;">
			  <li><a href="/main/index.php?act=day&m='. $nav['pmonth'] .'&d='. $nav['pday'] .'&y='. $nav['pyear'] .'">Yesterday</a></li>
			  <li><a href="/main/index.php?act=day&m='. $nav['nmonth'] .'&d='. $nav['nday'] .'&y='. $nav['nyear'].'">Tomorrow</a></li>
			  <br>
			  <br>
			  <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Create Event</button>
			</ul></div>
            '. 	$draw .'';
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New Event</h4>
      	</div>
      	
      	<div class="modal-body">
	    
	    <div class="form-group" style="width:270px;padding-left:15px;display:inline-block;">
		<label class="control-label" for="focusedInput">Event title:</label>
		<input class="form-control" id="focusedInput" type="text">
		</div>

		<div class="form-group" style="width:270px;padding-left:15px;display:inline-block;">
		<label class="control-label" for="focusedInput">Location:</label>
		<input class="form-control" id="focusedInput" type="text">
		</div>

		<div class="form-group">
      	<label for="textArea" class="col-lg-2 control-label">Event description:</label>
     	<div class="col-lg-10">
        <textarea class="form-control" rows="7" id="textArea"></textarea>
    	</div>
    	</div>

    	<div class="form-group">
     		<label for="select" class="col-lg-2 control-label">Date:</label>
      			<div class="col-lg-10" style="width:200px;display:inline-block;">
			        <select class="form-control" id="month" style="display:inline-block;">
			          <option>January</option>
			          <option>February</option>
			          <option>March</option>
			          <option>April</option>
			          <option>May</option>
			          <option>June</option>
			          <option>July</option>
			          <option>August</option>
			          <option>September</option>
			          <option>October</option>
			          <option>November</option>
			          <option>December</option>
			        </select>
			        <select class="form-control" id="day" style="width:75px;display:inline-block;">
			          <option>1</option>
			          <option>2</option>
			          <option>3</option>
			          <option>4</option>
			          <option>5</option>
			          <option>6</option>
			          <option>7</option>
			          <option>8</option>
			          <option>9</option>
			          <option>10</option>
			          <option>11</option>
			          <option>12</option>
			          <option>13</option>
			          <option>14</option>
			          <option>15</option>
			          <option>16</option>
			          <option>17</option>
			          <option>18</option>
			          <option>19</option>
			          <option>20</option>
			          <option>21</option>
			          <option>22</option>
			          <option>23</option>
			          <option>24</option>
			          <option>25</option>
			          <option>26</option>
			          <option>27</option>
			          <option>28</option>
			          <option>29</option>
			          <option>30</option>
			          <option>31</option>
			        </select>
			        <select class="form-control" id="year" style="width:75px;display:inline-block;">
			          <option>2014</option>
			          <option>2015</option>
			          <option>2016</option>
			        </select>
			         <div class="checkbox">
          				<label>
           				<input type="checkbox">Repeat?
          				</label>
        			 </div>
			    </div>
			</div>


		<div class="form-group">
     		<label for="select" class="col-lg-2 control-label">Time:</label>
      			<div class="col-lg-10" style="width:90px;display:inline-block;">
      				<label for="select" class="col-lg-2 control-label">From:</label>
			        <select class="form-control" id="hour" style="display:inline-block;">
			          <option>1</option>
			          <option>2</option>
			          <option>3</option>
			          <option>4</option>
			          <option>5</option>
			          <option>6</option>
			          <option>7</option>
			          <option>8</option>
			          <option>9</option>
			          <option>10</option>
			          <option>11</option>
			          <option>12</option>
			        </select>
			        :
			        <select class="form-control" id="minute" style="display:inline-block;">
			          <option>00</option>
			          <option>15</option>
			          <option>30</option>
			          <option>45</option>
			        </select>

			        <select class="form-control" id="AMPM" style="display:inline-block;">
			          <option>AM</option>
			          <option>PM</option>
			        </select>

			        <label for="select" class="col-lg-2 control-label">To:</label>
			        <select class="form-control" id="hour" style="display:inline-block;">
			          <option>1</option>
			          <option>2</option>
			          <option>3</option>
			          <option>4</option>
			          <option>5</option>
			          <option>6</option>
			          <option>7</option>
			          <option>8</option>
			          <option>9</option>
			          <option>10</option>
			          <option>11</option>
			          <option>12</option>
			        </select>
			        :
			        <select class="form-control" id="minute" style="display:inline-block;">
			          <option>00</option>
			          <option>15</option>
			          <option>30</option>
			          <option>45</option>
			        </select>

			        <select class="form-control" id="AMPM" style="display:inline-block;">
			          <option>AM</option>
			          <option>PM</option>
			        </select>
			    </div>
			</div>

			<div class="form-group">
		      <label class="col-lg-2 control-label">Event priority:</label>
		      <div class="col-lg-10">
		        <div class="radio">
		          <label>
		            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
		            Highest
		          </label>
		        </div>
		        <div class="radio">
		          <label>
		            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
		            Middle
		          </label>
		        </div>
		        <div class="radio">
		          <label>
		            <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
		            Lowest
		          </label>
		        </div>
		      </div>
		    </div>
    </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Create Event</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>

</html>