<title>Month</title>
<?php

echo '<center><div style="position:absolute; left:260px; top:101px; height:100%;">
            <div class="btn-group btn-group-justified" style="position:fixed; top:58px;width:77%;z-index:2;">
			  <a href="" class="btn btn-default">« Previous Month</a>
			  <a href="#" class="btn btn-default">'. date("F"). " " . date("Y"). '</a>
			  <a href="" class="btn btn-default">Next Month »</a>
			</div>
            '. draw_calendar(date("m"),date("Y")) . '
   	 </div></center>';

?>
