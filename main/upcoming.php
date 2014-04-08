<?php
$today = date("Y-m-d H:i:s");
$events = $mysql->getEvents( "NULL", $today ,"day");
$num_events = count($events);


if($num_events == '0')
{
$num_events = 'no';
}

$eventlist = '';
for($i = 0; $i < $num_events; $i++)
{
$eventlist .= $events[$i]["title"] . "&nbsp&nbsp&nbsp". $events[$i]["event_date"] ;
$eventlist .= '<br>';
}
?>

<html>
<head>
<title>Upcoming Events</title>
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/bootstrap/css/signin.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="template.css">
 <link href="/bootstrap/css/dashboard.css" rel="stylesheet">
</head>
<body><center><h1>Upcoming Events</h1>
<br> There are <?php echo $num_events; ?> upcoming events in the next 3 days.<br>
<br> <?php echo $eventlist; ?></center>
</div></body></html>