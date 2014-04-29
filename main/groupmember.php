<html>
<head>
<title>Groups</title>
<link rel="stylesheet" type="text/css" href="template.css">
<script src="/bootstrap/js/bootstrap.js" type="text/javascript"></script>
</head>

<body><div style="padding-left:260px;padding-top:20px;">

<?php

$user = $mysql->select('user', array('avatar','info','first_name','last_name'), "id = ".$_GET['id']."");
$permission = $mysql->select('group_user', 'permission', "gid = ".$_GET['gid']." AND userid = ".$_GET['id']."");
if ($permission == 1){$rank = 'owner';}
else if ($permission == 2){$rank = 'admin';}
else {$rank = 'member';}

echo '<div id="one" style="width:1000px">
 <div style="width:500px;float:left;">
 <center><h1>'.$user['first_name'].' '.$user['last_name'].' : '.$rank.'</h1><br>
		About me : <br>'.$user['info'].'<br>
		</div>
 <div style="width:500px;float:right;">	
		<img src='.$user['avatar'].' alt="Avatar could not be displayed" width="304" height="228"></div></div>';
?>

</body></html>