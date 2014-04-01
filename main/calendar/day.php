<title>Day</title>
<?php
require_once('CalendarFunctions.php');
echo '<body onload="startTime()"><div class="day">
            '. draw_day(date("d")) . '
          </div>
        </div>
      </div>
    </div></body>'
?>