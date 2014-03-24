<html>
	<head>
		<link rel="stylesheet" type="text/css" href="template.css">
		<script src="SidebarJavaScript/SpryMenuBar.js" type="text/javascript"></script>
		<script src="CalendarJsFunctions.js"></script>
		<link href="SidebarJavaScript/SpryMenuBarVertical.css" rel="stylesheet" type="text/css">
		<title> Calendar </title>
	</head>
	<body>
		<div class="sidebar">
			<center><h1>Calendar</h1></center>
				<br>
		    <ul class="MenuBarVertical" id="sidebar">
		    	<li>
		    		Latest:
		    		<br>
		    		Working on small month view atm.
		    		<br>
		    		Hayden: Organizing main page and working on formatting sidebar, header, and actual calendar container.
		    	</li>
		    	<li>
					<a href="yeartest.php">Year Test</a>
		    	</li>
				<li>
					<a href="daytest.php">Day Test</a> 
				</li>
		    	<br>
		    	<br>

		    	<!--------------> 
                <li>
                    <a class="MenuBarActive" href="template.php" id="current">Home</a>
                </li>
				
                <li>
				    <a href="index.html">Login (Doesn't work)</a>
				</li>
				
                <li>
                    <a href="index.html">Resg (Doesn't work)</a>
                </li>

                <li>
                    <a href="index.html">FAQ (Doesn't work)</a>
                </li>

				<li>
				    <a href="index.html">Help (Doesn't work)</a>
				</li>
				
                <li>
                    <a href="index.html">Contact Us? (Doesn't work)</a>
                </li>
            </ul><!-- end .sidebar1 --> 
		    <br>           
		</html><?php include 'CalendarFunctions.php'; echo draw_small_month(date("m"),date("Y")); ?><html>
		</div>

		<div class="title">
				<h1><center>  
					<?php echo date("F"), " ", date("j"), ", ", date("Y"); ?>
				</h1></center>
			</div>

		<div class="container">
			<div class="body">
				<?php
					//include 'CalendarFunctions.php';
					/*Removed to print month in heading instead
					echo "Today's date is: ", date("M"), " ", date("d"), " ", date("Y");
					echo draw_small_month(date("m"),date("Y")); 
					echo '<h2>March 2014</h2>';
					*/
					echo draw_calendar(date("m"),date("Y"));
					//print_r(getdate());
				?>
			</div>
		</div>
			<script type="text/javascript">
				var MenuBar1 = new Spry.Widget.MenuBar("sidebar", {imgRight:"../SidebarJavaScript/SpryMenuBarRightHover.gif"});
			</script>
	</body>
</html>
