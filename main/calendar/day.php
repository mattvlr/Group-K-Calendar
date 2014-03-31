<title>Day</title>
<?php
require_once('CalendarFunctions.php');
echo '<div class="day">
            '. draw_day(date("d")) . '
          </div>
        </div>
      </div>
    </div>'
?>