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

echo 'first name : '.$user['first_name'].'<br>
		last name : '.$user['last_name'].'<br>
		info : '.$user['info'].'<br>
		permission : '.$permission.'<br>
		<img src='.$user['avatar'].' alt="Avatar could not be displayed" width="304" height="228">';
?>

</body></html>