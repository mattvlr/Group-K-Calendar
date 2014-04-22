<?php 
//Check for sessions
if(isset($_SESSION["username"]))
{
$nav_pages = '
    <ul class="nav navbar-nav navbar-right">
    <li class=""><a href="?act=upcoming">Upcoming Events</a></li>
    <li class=""><a href="?act=groups">Groups</a></li>
       <li class="dropdown" style="padding-right:10px;">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $_SESSION['username'] . '<b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="?act=settings">Settings</a></li>
          <li><a href="?act=help">Help</a></li>
          <li class="divider"></li>
          <li><a href="?act=logout">Logout</a></li>
        </ul>
      </li>
    </ul>';
}
else
{
  $nav_pages = '';
}

$navbar = '
	<div class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
          <img src="http://i.imgur.com/pamXbHx.png" style="position:absolute; padding-top:5px; left:-18px;"/>
        </div>
          ' . $nav_pages . '
    </div>';

//if(isset($_SESSION["first_name"]) && isset($_SESSION["last_name"]))
//{
  echo $navbar;
//}
?>