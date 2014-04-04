<?php
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

	?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/main/template.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#right").click(function(){
    $("#div1").load("test.txt");
  });
});
</script>
</head>
<body>
<a href="/main/index.php">Home</a>
<br>
<div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div>
<button>Get External Content</button>
<br>
<br>
<?php
include('CalendarFunctions.php');

echo 	'<div id="sidebar-small-month">'. draw_small_month(date("m"),date("Y")) .'</div>
		<div id="left" style="float:left;width:20px">
		<a href="?month='.$mc.'&year='.$yc.'&tar=b">&#8592;(prev)</a></div>
		<div id="right" style="padding-left:100px">
		<a href="?month='.$mc.'&year='.$yc.'&tar=f">&#8594;(next)</a></div>';
print_r($_GET);
?>
</body>
</html>