<?php
require_once('mysql/_db.php');
require_once('mysql/_mysql.php');
session_start();



$privledge = '0';  //set to 0 for guest

$mysql = new mysql_driver;
$mysql->connect();

if(isset($_SESSION["id"]) && isset($_SESSION["username"]) && isset($_SESSION["first_name"]) && isset($_SESSION["last_name"])  && isset($_SESSION["permission"]))
{
	$username = $_SESSION['username'];
	$first_name = $_SESSION['first_name'];
	$last_name = $_SESSION['last_name'];
	$avatar = $_SESSION['avatar'];
	$permission = $_SESSION['permission'];
}
else if(isset($_COOKIE['id']))
{
	$sess = $mysql->getSessionInfo($_COOKIE['id']);
	if(!$sess)
	{
	echo "COOKIE ERROR!";
	}
	else
	{
	$username = $sess['username'];
	$first_name = $sess['first_name'];
	$last_name = $sess['last_name'];
	$avatar = $sess['avatar'];
	$permission = $sess['permission'];
	

	$_SESSION['id'] = $username;
	$_SESSION['username'] = $username;
	$_SESSION['first_name'] = $first_name;
	$_SESSION['last_name'] = $last_name;
	$_SESSION['avatar'] = $avatar;
	$_SESSION['permission'] = $permission;
	}
}
else
{
	//Not logged in...
}


if(isset($_GET['act']) && $_GET['act'] == 'logout')
{
setcookie('id', '', time() - 3600);
if(session_destroy())
{
	header("Location: index.php?act=logged");
}
}
?>