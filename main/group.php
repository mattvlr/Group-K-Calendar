<html>
<head>
<title>Groups</title>
<link rel="stylesheet" type="text/css" href="template.css">
<script src="/bootstrap/js/bootstrap.js" type="text/javascript"></script>
</head>

<body><div style="padding-left:260px;padding-top:20px;">
  
<?php 

echo '<div style="width:1000px;padding-top:60px">';
		
echo '<div style="width:500px;float:left;">';

//Getting the group you clicked on and displaying its info
$group = $mysql->select('groups', array('gid','ownerid','date_created','title','description'), "gid = ".$_GET['id']."");
$owner = false;
$admin = false;
$get_rank = $mysql->select('group_user', 'permission', "userid = ".$_GET['id']."");
if ($group['ownerid'] == $id){$owner = true;}
else if ($get_rank == 2){$admin = true;}
echo '<center><h1>'.$group['title'].'</h1>
		<h4>Created '.$group['date_created'].'</h4>
		<h2><br></h2>
		<p>'.$group['description'].'</p>';
		if ($owner)
		echo '<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#editGroupModal">Edit Group</button></center></div>';
		else
		echo '</center></div>';

//Getting all members in this group
echo '<div style="width:500px;float:right;">';

echo '<center><h2>Group Members</h2>';
$users = $mysql->getGroupMembers($_GET['id']);
$num_users = count($users); 

		for($i = 0; $i < $num_users; $i++){
		$user = $mysql->select('user', array('id','first_name','last_name'), "id = ".$users[$i]['userid']."");
			if ($users[$i]['permission'] == 3){$rank = 'member';}
			else if ($users[$i]['permission'] == 2){$rank = 'admin';}
			else {$rank = 'owner';}
  			echo '<a href="/main/index.php?act=groupmember&gid='.$_GET['id'].'&id='.$user['id'].'" class="list-group-item">
    			<p align="middle">'.$user['first_name'].' '.$user['last_name'].' : '.$rank.'</p>
  				</a>';}
  			if ($owner)
		echo '<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#addUserModal">Invite Users To Group</button></center></div>';
		else
  		echo '</center></div>';
  		
//Group edit form
$edit_form = '<div class="groupedit">
	<form class="form-signin" role="form" action="/main/index.php?act=group&id='.$_GET['id'].'" method = "post">
	<center><h1>Edit your group!</h1></center>
	<input type="text" name = "title" class="form-control" placeholder="'.$group['title'].'" required autofocus>

	<textarea class="form-control" rows="5" name="description" placeholder="'.$group['description'].'" required></textarea><br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Save Changes</button>
	</form>
	</div>';
	
$add_form = '<div class="adduser">
	<form class="form-signin" role="form" action="/main/index.php?act=group&id='.$_GET['id'].'" method = "post">
	<center><h1>Add User</h1></center>
	<input type="text" name = "username" class="form-control" placeholder="username" required autofocus>
	
	<center><b>Rank:</b></center>
	<center><input type="radio" name="permission" value="3" checked="">member
	<input type="radio" name="permission" value="2">admin</center><br>

	<textarea class="form-control" rows="5" name="message" placeholder="message to user" required></textarea><br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Send Invite</button>
	</form>
	</div>';
	
//Updating info after group edit form is submitted
	if (isset($_POST['title']) && isset($_POST['description'])){

	if ($mysql->update('groups'  , 'title="'.$_POST['title'].'" , description="'.$_POST['description'].'"'  ,  'gid="'.$_GET['id'].'"'))
		echo 'success';
	else
		echo 'failure';
	}	
	
//Sending email after add user form is submitted
require_once('smtp/Send_Mail.php');
if (isset($_POST['username']) && isset($_POST['message'])){
	if ($mysql->exists('user','username="'.$_POST['username'].'"')){
		$email = $mysql->select('user','email','username="'.$_POST['username'].'"');
		$group_owner = $mysql->select('user','first_name','id="'.$group['ownerid'].'"');
		$content = 'You have been invited to the the group : '.$group['title'].'
		.  '.$group_owner.', the group owner says : '.$_POST['message'].'';
		Send_Mail($email,"Group Invite",$content);
		
		$userid = $mysql->select('user','id','username="'.$_POST['username'].'"');
		$array = array (
							'gid' => $_GET['id'],
							'userid' => $userid,
							'permission' => $_POST['permission']
						);
		$mysql->insert('group_user',$array);
							
		echo 'email sent';
	}
	else
		echo 'fail';
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
</div>

	<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New User</h4>
      	</div>
      	
      	<div class="modal-body">

		<?php echo ''.$add_form.''; ?>
		
		<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

</body></html>