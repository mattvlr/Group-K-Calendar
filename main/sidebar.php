<html><script>
$(document).ready(function(){
	<?php echo '$("#sidebar-small-month").load("sbsmi.php?month='.$mc.'&year='.$yc.'");'; ?>
});
</script></html>
<?php 
require_once('/calendar/CalendarFunctions.php');

if(isset($_SESSION['id']))
{
	//highlight the currently selected view
	$m = '';
	$y = '';
	$d = '';

	if(isset($_GET['act']) && $_GET['act'] == 'year')
	{
	$y = 'class="active"';
	}
	else if(isset($_GET['act']) && $_GET['act'] == 'day')
	{
	$d = 'class="active"';
	}
	else if(isset($_GET['act']) && $_GET['act'] == 'month')
	{
	$m = 'class="active"';
	}
	//Generate views section
	$views = "";
	$sidebar = "";
	$views= '<li '.$m.'><a href="?act=month">Month</a></li>
			 <li '.$y.'><a href="?act=year">Year Test</a></li>
			 <li '.$d.'><a href="?act=day">Day Test</a></li>';
		 
	$sidebar .= '<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="list-group-item">
              <span class="badge">14</span>
                Messages
            <li class="list-group-item">
               <span class="badge">3</span>
                Upcoming Events
            <li><a href="#">Group Invites</a></li>
          </ul>
          <ul class="nav nav-sidebar">
		'.$views.'</ul>';
		
		if(!isset($_GET['year'])){
			$yc = date('Y');
		}
		else{
			$yc = $_GET['year'];
		}
		//
		if(!isset($_GET['month'])){
			$mc = date('m');
		}
		else{
			$mc = $_GET['month'];
		}
		//
		if(isset($_GET['tar'])){
			if($_GET['tar'] == 'f'){
			$mc++;
			if($mc > 12):
				$mc = 1;		
				$yc++;
			endif;
			}
			elseif($_GET['tar'] == 'b'){
			$mc--;
			if($mc < 1):
				$mc = 12;
				$yc--;
			endif;
			}
		}

		$sidebar .= '<div id="sidebar-small-month">'. draw_small_month(date("m"),date("Y"),1).'</div>
			 <div id="left" style="float:left;width:20px">
			 <a href="?month='.$mc.'&year='.$yc.'&tar=b">&#8592;(prev)</a></div>
			 <div id="right" style="float:right">
			 <a href="?month='.$mc.'&year='.$yc.'&tar=f">(next)&#8594;</a></div>
		
				<br>
		 `	 	<br>
				AJAX Test <a href="/main/calendar/ajaxtest.php">Link</a><br>
				Modal Test  <a href="/main/calendar/modaltest.php">Link</a>
				</div>';
}
else    //Sidebar only for logged in users?
{
$sidebar = '';
}

echo $sidebar;
?>