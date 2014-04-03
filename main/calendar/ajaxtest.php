<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="template.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("button").click(function(){
    $("#div1").load("drawsmallmonth.php");
  });
});
</script>
</head>
<body>
<a href="/main/index.php">Home</a>
<br>
<div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div>
<button>Get External Content</button>
<?php
include('CalendarFunctions.php');
echo '<div id="sidebar-small-month">'. draw_small_month(date("m"),date("Y")) .'</div><div style="float:left;width:20px"><a id="loadleftmonth" href="">&#8592;</a></div><div style="float:right;"><a id="loadrightmonth" href="#rightmonth">&#8594;</a></div>'; 
?>
</body>
</html>