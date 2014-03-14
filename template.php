<html>
	<head>
		<link rel="stylesheet" type="text/css" href="template.css">
		<script src="SidebarJavaScript/SpryMenuBar.js" type="text/javascript"></script>
		<script src="CalendarJsFunctions.js"></script>
		<link href="SidebarJavaScript/SpryMenuBarVertical.css" rel="stylesheet" type="text/css">
		<title> Calendar </title>
	</head>
	<body>
		<div class="container">
		<div class="title">
			<h1><center> Calendar</center> </h1>
		</div>
		
		<div class="sidebar">
		    <ul class="MenuBarVertical" id="sidebar">
                <li>
                    <a class="MenuBarActive" href="template.php" id="current">Home</a>
                </li>
				
                <li>
				    <a href="index.html">Login</a>
				</li>
				
                <li>
                    <a href="index.html">Resg</a>
                </li>

                <li>
                    <a href="index.html">FAQ</a>
                </li>

				<li>
				    <a href="index.html">Help</a>
				</li>
				
                <li>
                    <a href="index.html">Contact Us?</a>
                </li>
            </ul><!-- end .sidebar1 -->
		</div>
		<div class="body">
			<p><br><a href="yeartest.php">Year Test</a> <- is where I'm currently working, going to use the small calendar below to make a year view.</p>

<?php

	include 'CalendarFunctions.php';

	echo "Today's date is: ", date("M"), " ", date("d"), " ", date("Y");
	echo draw_small_month(date("m"));
	echo '<h2>March 2014</h2>';
	echo draw_calendar(date("m"),date("Y"));
	print_r(getdate());


?>
		</div>
		</div>
			<script type="text/javascript">
				var MenuBar1 = new Spry.Widget.MenuBar("sidebar", {imgRight:"../SidebarJavaScript/SpryMenuBarRightHover.gif"});
			</script>
	</body>
</html>
