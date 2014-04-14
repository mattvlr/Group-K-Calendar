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
  <li class=""><a href="index.php?act=groups" data-toggle="tab"><?php echo $_SESSION["first_name"];?>'s Groups</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home" style="padding-left:20px;">
        There are <?php echo $num_events; ?> upcoming events in the next 3 days.
        <br>

        <table class="table table-striped table-hover" style="position:fixed; left:260px;">
          <thead>
            <tr>
              <th>#</th>
              <th>Event Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Location</th>
              <th>Creator</th>
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
    
      <td style="width:2%;"><?php echo $i+1; ?></td>
      <td style="width:125px;"><?php echo $events[$i]["title"]; ?></td>
      <td style="width:75px;"><?php echo $date;?></td>
		  <td style="width:75px;"><?php echo $time;?></td>
      <td style="width:100px;"><?php echo $events[$i]["location"]; ?></td>
      <td style="width:200px;"><?php echo $owner;?></td>
    </tr>

<?php 
} 
?>

        </tbody>
        </table> 
  </div>
</div>
</div></body></html>