<title>Month</title>
<?php

echo '<div style="position:absolute; left:260px; top:30px;">
            <h1 class="page-header">
            '. date("F"). " " . date("Y"). '
            </h1>
            '. draw_calendar(date("m"),date("Y")) . '
   	 </div>';

?>
