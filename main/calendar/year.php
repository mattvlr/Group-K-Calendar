<html>
<head>
<title>Year</title>
<?php
require_once('CalendarFunctions.php');

	if(!isset($_GET['y'])){
			$year = date('Y');
	}
	else{
			$year = $_GET['y'];
	}

	$nav = yearNav($year); 

echo '
<div style="position:absolute; top:28px;left:260px;">
			<div class="btn-group btn-group-justified" style="position:fixed; top:58px;width:77%;z-index:2;">
			  <a href="/main/index.php?act=year&y='. $nav['pyear'] .'" class="btn btn-default">« Previous Year</a>
			  <a href="#" class="btn btn-default">'. $year . '</a>
			  <a href="/main/index.php?act=year&y='. $nav['nyear'] .'" class="btn btn-default">Next Year »</a>
			</div>
            '. draw_year($year) . '
      </div>
    </div>'
?>

</body>
</html>