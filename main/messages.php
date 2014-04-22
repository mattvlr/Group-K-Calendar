<html>
<head>
<title>Messaging</title>
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

<div id="myTabContent" class="tab-content">
  <div style="padding-left:20px; padding-top:20px;">
	You have <?php echo $msgs; ?> unread messages.<br>
	<?php
		echo $messagelist;
	?>
	</div>
</div>
</body></html>