<html>
<head>
<title>Groups</title>
<link rel="stylesheet" type="text/css" href="template.css">
<script src="/bootstrap/js/bootstrap.js" type="text/javascript"></script>
</head>

<body><div style="padding-left:260px;">

<ul class="nav nav-tabs" style="margin-bottom:15px;padding-top:20px;">
  <li class=""><a href="index.php?act=upcoming" data-toggle="tab"><?php echo $num_events;?> Upcoming Events</a></li>
  <li class=""><a href="index.php?act=pm" data-toggle="tab">Messages</a></li>
  <li class="active"><a href="" data-toggle="tab"><?php echo $_SESSION["first_name"];?>'s Groups</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home" style="padding-left:20px;">
  
  	<?php
	$groups_created = $mysql->getGroupsCreated($id);
	if($groups_created != false)
	{
	$num_groups = count($groups_created);
	}
	else
	{
	$num_groups = 0;
	}
	
	$status = '';
	
	$body = '<div class="eventcreation">
	<form class="form-signin" role="form" action="/main/index.php?act=groups" method = "post">
	<center><h1>Create your group!</h1></center>
	<input type="text" name = "title" class="form-control" placeholder="Group Title" required autofocus>
	
	<center><b>Priority</b></center>
	<center><input type="radio" name="priority" value="0" checked="">None
	<input type="radio" name="priority" value="1">Low
	<input type="radio" name="priority" value="2">Medium
	<input type="radio" name="priority" value="3">High</center><br>

	<textarea class="form-control" rows="5" name="description" placeholder="description of event" required></textarea><br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
	</form>
	</div>';

	if (isset($_POST['title']) && isset($_POST['description'])){
	
	$date = date("Y-m-d");

	$groupinfo = array(	'ownerid' => $id,
						'date_created' => $date,
						'priority' => $_POST['priority'],
						'title' => $_POST['title'],
						'description' => $_POST['description']
						);
						
	if($mysql->insert('groups',$groupinfo))
	{
		$status = 'Group Created!!';
	}
	else
	{
		$status = 'Error occurred, group not added';
	}
	
	echo ''.$status.'';
}

	if ($num_groups == 0){
		echo '<center><h1>You do not own any groups</h1></center>';}
	else{
		echo '<center><h1>Your Groups:</h1></center>';
		
		echo '<center><div class="list-group">';
		
		for($i = 0; $i < $num_groups; $i++){
  			echo '<a data-toggle="modal" data-target="#myModal" class="list-group-item">
    			<p align="middle">Title : '.$groups_created[$i]['title'].'</p>
    			<p align="middle">Date Created : '.$groups_created[$i]['date_created'].'</p>
    			<p align="middle">Priority : '.$groups_created[$i]['priority'].'</p>
    			<p align="middle">Description : '.$groups_created[$i]['description'].'</p>
  				</a>';}
  			echo '</div></center>';
  		}
	?>  
	
</div>

	<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Create new group</button>
	
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New Group</h4>
      	</div>
      	
      	<div class="modal-body">
	    
	    <?php
		echo ''.$body.'';
		?>
		
		<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

</div>
</div>
</body></html>