<html>
<head>
<title>Messaging</title>
<link rel="stylesheet" type="text/css" href="template.css">
<link href="/bootstrap/css/dashboard.css" rel="stylesheet">
</head>
<body><div style="padding-left:260px;">

<?php

$messagelist = "A<br>B<br>";
$msgs = 0;

if($msgs == 0);
{
$msgs = 'no';
$msgs_2 = 'No';
}
?>

<ul class="nav nav-tabs" style="margin-bottom: 15px;padding-left:10px; padding-top:20px;">
  <li class=""><a href="index.php?act=upcoming" data-toggle="tab"><?php echo $num_events;?> Upcoming Events</a></li>
  <li class="active"><a href="" data-toggle="tab"><?php echo $msgs_2;?> New Messages</a></li>
  <li class=""><a href="index.php?act=groups" data-toggle="tab">Groups</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home" style="padding-left:20px;">
	You have <?php echo $msgs; ?> unread messages.<br>
	<?php
		echo $messagelist;
	?>
	</div>
</div>
</body></html>