<html>
<head>
<title>Upcoming Events</title>
<link rel="stylesheet" type="text/css" href="template.css">
<link href="/bootstrap/css/dashboard.css" rel="stylesheet">
</head>
<body><div style="padding-left:260px;">

<?php
$today = date("Y-m-d H:i:s");
$events = $mysql->getEvents( "NULL", $today ,3,'asc');
if($events != false)
{
$num_events = count($events);
}
else
{
$events = 0;
}

if($num_events == '0')
{
$num_events = 'no';
}

$eventlist = '';

?>

<ul class="nav nav-tabs" style="margin-bottom:15px; padding-top:20px;">
  <li class="active"><a href="" data-toggle="tab"><?php echo $num_events;?> Upcoming Events</a></li>
  <li class=""><a href="index.php?act=pm" data-toggle="tab">Messages</a></li>
  <li class=""><a href="index.php?act=groups" data-toggle="tab">Groups</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home" style="padding-left:20px;">
        There are <?php echo $num_events; ?> upcoming events in the next 3 days.<br> Draft with SQL data:
        <br>

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
<?php


for($i = 0; $i < $num_events; $i++)
{
$owner = $mysql->getUsername($events[$i]["ownerid"])['username'];
$date = explode(" ",$events[$i]["event_date"],2 );
$time = $date[1];
$date = $date[0];

if($events[$i]["priority"] == '0')
{
echo '<tr>';
}
elseif($events[$i]["priority"] == '1')
{
echo '<tr class="success">';
}
elseif($events[$i]["priority"] == '2')
{
echo '<tr class="warning">';
}
elseif($events[$i]["priority"] == '3')
{
echo '<tr class="danger">';
}
?>
    
      <td><?php echo $i; ?></td>
      <td><?php echo $events[$i]["title"]; ?></td>
      <td><?php echo $date;?></td>
		<td><?php echo $time;?></td>
      <td><?php echo $events[$i]["location"]; ?></td>
      <td><?php echo $owner;?></td>
    </tr>

<?php 
} 
?>

        </tbody>
        </table> 

        Finished Example:

        <br>

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
            <tr>
              <td>5</td>
              <td>Event</td>
              <td>1/1/2014</td>
              <td>10:00AM</td>
              <td>Over there</td>
              <td>Clay</td>
            </tr>
          </tbody>
        </table> 
  </div>
</div>
</div></body></html>