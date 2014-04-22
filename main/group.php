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

$group = $mysql->select('groups', array('gid','ownerid','date_created','title','description'), "gid = ".$_GET['id']."");
echo '<center><h1>'.$group['title'].'</h1>
		<h4>Created '.$group['date_created'].'</h4>
		<h2>Description:</h2>
		<p>'.$group['description'].'</p></center></div>';

echo '<div style="width:500px;float:left;">';

$users = $mysql->getGroupMembers($_GET['id']);

echo '<p>'.$users[0]['userid'].''.$_GET['id'].'</p>';

/*$users = $mysql->getGroupMembers($id);
		for($i = 0; $i < $users; $i++){
		$user = $mysql->select('user', array('id','first_name','last_name'), "id = ".$users[$i]['userid']."");
  			echo '<a data-toggle="modal" data-target="#myModal" class="list-group-item">
    			<p align="middle">Title : '.$user[$i]['first_name'].'</p>
  				</a>';}
echo '<p><center>egrshtfyjgukhilkgjyhtrg</p></center>';*/

?>

</div>
</div>
</body></html>