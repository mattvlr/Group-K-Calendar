<?php
require_once('mysql/_mysql.php');
$mysql = new mysql_driver;
$mysql->connect();

$msg = 'fail';

$perm = $mysql->select('user','permission','activation="'.$_GET['code'].'"');
if($perm > '0')
{
	$msg = 'Your account is now activated<br>
			Login <a href="index.php?act=login">here</a>!';
}
else if($perm == '0')
{
	if($mysql->update('user',"permission='1'",'activation="'.$_GET['code'].'"'))
	{ 
		$msg = 'Your account is now activated<br>
				Login <a href="index.php?act=login">here</a>!';
	}
	else
	{
		$msg = 'Failed';
	}
}
else
{
$msg = 'invalid activation, Please re-send your validation link';
}


?>
<?php echo $msg; ?>