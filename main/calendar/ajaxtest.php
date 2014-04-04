
<html>
<head>
<link rel="stylesheet" type="text/css" href="/main/template.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>

  $("#right").click(function(){
	<?php 
		$mc = $_GET['month'] + 1;
			if($mc > 12):
				$mc = 1;
				$yc = $_GET['year'];
			endif;
	?>
    $("#sidebar-small-month").load("test.txt");
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

echo '<div id="sidebar-small-month">'. draw_small_month(date("m"),date("Y")) .'</div>
<div id="left" style="float:left;width:20px"><a href="?month='.$mc.'#?year='.$yc.'">&#8592;</a></div><div id="right" style=""><a href="?month='.$mc.'#?year='.$yc.'">&#8594;</a></div>';
print_r($_GET);
?>
</body>
</html>