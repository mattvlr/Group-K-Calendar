<html>
	<head>
		<link rel="stylesheet" type="text/css" href="template.css">
		<script src="SidebarJavaScript/SpryMenuBar.js" type="text/javascript"></script>
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
			<p>Also as a little experiment I made the current day a different color from the rest, and fixed the height problem. Also the date is off by <b>one</b>, not really sure why. And the solid color boxes are only for layout.</p>
			<p>-Matt</p>
			<br>

<?php

	include '../PhpFunctions/CalendarFunctions.php';

	echo "Today's date is: ", date("M"), " ", date("d"), " ", date("Y");
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
