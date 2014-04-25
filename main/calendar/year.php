<html>
<head>
<title>Year</title>
<?php
require_once('CalendarFunctions.php');

echo '
<div style="position:absolute; top:28px;left:260px;">
			<div class="btn-group btn-group-justified" style="position:fixed; top:58px;width:77%;z-index:2;">
			  <a href="" class="btn btn-default">« Previous Year</a>
			  <a href="#" class="btn btn-default">'. date("Y"). '</a>
			  <a href="" class="btn btn-default">Next Year »</a>
			</div>
            '. draw_year(2014) . '
      </div>
    </div>'
?>

</body>
</html>