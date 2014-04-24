<html>
<head>
<title>Groups</title>
</head>

<body><div style="padding-left:260px;">

<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home" style="padding-left:20px;">
  
  	<?php
  	
  	//Getting the groups you own
	$groups_created = $mysql->getGroupsCreated($id);
	if($groups_created != false)
	{
	$num_groups = count($groups_created);
	}
	else
	{
	$num_groups = 0;
	}
	
	//Error testing
	$status = '';
	$status2 = '';
	
	//Group creation form
	$body = '<div class="groupcreation">
	<form class="form-signin" role="form" action="/main/index.php?act=groups" method = "post">
	<center><h1>Create your group!</h1></center>
	<input type="text" name = "title" class="form-control" placeholder="Group Title" required autofocus>

	<textarea class="form-control" rows="5" name="description" placeholder="Group Description" required></textarea><br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
	</form>
	</div>';

	//Things that need to happen after the form is submitted
	if (isset($_POST['title']) && isset($_POST['description'])){
	
	$date = date("Y-m-d");

	//Getting data for groups table
	$groupinfo = array(	'ownerid' => $id,
						'date_created' => $date,
						'title' => $_POST['title'],
						'description' => $_POST['description']
						);
						
	//Putting data in the groups table
	if($mysql->insert('groups',$groupinfo))
{
		$status = 'Group Created!!';
		
	//Associating group that just got created with the group_user table
	$groups = $mysql->getGroupsCreated($id);
	$gid = $groups[(count($groups)-1)]['gid'];
	$array = array( 'gid' => $gid,
					'userid' => $id,
					'date_joined' => $date,
					'permission' => "1");
	
	//Putting data in the group_user table
	if ($mysql->insert('group_user',$array))
	{
		$status2 = 'success';
	}
	else
	{
		$status2 = 'fuck';
	}
	echo ''.$status2.'';
	
}
	else
	{
		$status = 'Error occurred, group not added';
	}
	echo ''.$status.'';
	

	
}

	//Generating the groups page with your groups
	if ($num_groups == 0){
		echo '<center><h1>You do not own any groups</h1>';
		echo '<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Create new group</button></center>';}
	else{
		echo '<div id="one" style="width:1000px"><center><h1>Groups:</h1></center>';
		
		echo '<div class="list-group" style="width:500px;float:left;">';
		echo '<center><h4>Groups Owned:</h4></center>';
		
		for($i = 0; $i < $num_groups; $i++){
  			echo '<a href="/main/index.php?act=group&id='.$groups_created[$i]['gid'].'" class="list-group-item">
    			<p align="middle">'.$groups_created[$i]['title'].'</p>
    			<p align="middle">Created : '.$groups_created[$i]['date_created'].'</p>
  				</a>';}
  			echo '<center><button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Create new group</button></center></div>';
		
		echo '<div class="list-group2" style="width:500px;float:right;">';
		echo '<center><h4>Groups Joined:</h4></center>';
		
		for($i = 0; $i < $num_groups; $i++){
  			echo '<a data-toggle="modal" data-target="#myModal" class="list-group-item">
    			<p align="middle">Title : '.$groups_created[$i]['title'].'</p>
    			<p align="middle">Date Created : '.$groups_created[$i]['date_created'].'</p>
    			<p align="middle">Description : '.$groups_created[$i]['description'].'</p>
  				</a>';}
  			echo '</div></div>';
  		}
	?>  
	</div></div>
	
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