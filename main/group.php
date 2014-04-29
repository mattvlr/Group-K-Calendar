<html>
<head>
<title>Groups</title>
<link rel="stylesheet" type="text/css" href="template.css">
<script src="/bootstrap/js/bootstrap.js" type="text/javascript"></script>
</head>

<body><div style="padding-left:260px;padding-top:20px;">
  
<?php 
echo '<div style="width:1000px">';
		
echo '<div style="width:500px;float:left;">';

//Getting the group you clicked on and displaying its info
$group = $mysql->select('groups', array('gid','ownerid','date_created','title','description'), "gid = ".$_GET['id']."");
echo '<center><h1>'.$group['title'].'</h1>
		<h4>Created '.$group['date_created'].'</h4>
		<h2>Description:</h2>
		<p>'.$group['description'].'</p>
		<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#editGroupModal">Edit Group</button></center></div>';


//Getting all members in this group
echo '<div style="width:500px;float:left;">';

echo '<center><h2>Group Members</h2>';
$users = $mysql->getGroupMembers($_GET['id']);
$num_users = count($users); 

		for($i = 0; $i < $num_users; $i++){
		$user = $mysql->select('user', array('id','first_name','last_name'), "id = ".$users[$i]['userid']."");
  			echo '<a href="/main/index.php?act=groupmember&gid='.$_GET['id'].'&id='.$user['id'].'" class="list-group-item">
    			<p align="middle">'.$user['first_name'].' '.$user['last_name'].' : joined on '.$users[$i]['date_joined'].'</p>
  				</a>';}
  		echo "</center></div>";

//Group edit form
$edit_form = '<div class="groupedit">
	<form class="form-signin" role="form" action="/main/index.php?act=group&id='.$_GET['id'].'" method = "post">
	<center><h1>Edit your group!</h1></center>
	<input type="text" name = "title" class="form-control" placeholder="'.$group['title'].'" required autofocus>

	<textarea class="form-control" rows="5" name="description" placeholder="'.$group['description'].'" required></textarea><br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Save Changes</button>
	</form>
	</div>';
	
//Updating info after form is submitted
	if (isset($_POST['title']) && isset($_POST['description'])){

	if ($mysql->update('groups'  , 'title="'.$_POST['title'].'" , description="'.$_POST['description'].'"'  ,  'gid="'.$_GET['id'].'"'))
		echo 'success';
	else
		echo 'failure';
	}	

?>

</div>
</div>

	<div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Group</h4>
      	</div>
      	
      	<div class="modal-body">

		<?php echo ''.$edit_form.''; ?>
		
		<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

</body></html>