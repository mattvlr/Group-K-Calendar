<title>Month</title>
<?php
require_once('CalendarFunctions.php');
echo '<center><div class="calendar">
            <h1 class="page-header">
            '. date("F"). " " . date("Y"). '
            </h1>
            '. draw_calendar(date("m"),date("Y")) . '
          </div>
        </div>
      </div>
    </div></center>'
?>
