

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

<br>
<br>

<center>This is what I have in mind for the event list. <br>Maybe click event to go to event page with description/options etc.<br>Colors represent priority?<br>Enumerate html table with PHP elements.
<table class="table table-striped table-hover" style="width:600px;" >
  <thead>
    <tr>
      <th>#</th>
      <th>Event Name</th>
      <th>Date</th>
      <th>Time</th>
      <th>Location</th>
      <th>Owner/Creator</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Meeting</td>
      <td>1/1/2014</td>
      <td>8:00AM</td>
      <td>Somewhere</td>
      <td>Matt</td>
    </tr>
    <tr class="success">
      <td>2</td>
      <td>Event</td>
      <td>1/1/2014</td>
      <td>8:30AM</td>
      <td>There</td>
      <td>Hayden</td>     
    </tr>
    <tr class="danger">
      <td>3</td>
      <td>Meeting</td>
      <td>1/1/2014</td>
      <td>9:00AM</td>
      <td>Anywhere</td>
      <td>Pete</td>
    </tr>
    <tr class="warning">
      <td>4</td>
     <td>Meeting</td>
      <td>1/1/2014</td>
      <td>9:30AM</td>
      <td>Back there</td>
      <td>Kenny</td>
    </tr>
    <tr class="active">
      <td>5</td>
      <td>Event</td>
      <td>1/1/2014</td>
      <td>10:00AM</td>
      <td>Over there</td>
      <td>Clay</td>
    </tr>
  </tbody>
</table> 
</center>
</div></body></html>