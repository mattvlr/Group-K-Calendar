<title>Day</title>
<?php
require_once('CalendarFunctions.php');
$day = $_GET['d'];
$month = $_GET['m'];
$year = $_GET['y'];
echo '<div class="day">
            '. draw_day($day,$month,$year) . '
          </div>
        </div>
      </div>
    </div>'
?>