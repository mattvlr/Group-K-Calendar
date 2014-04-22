<?php 
//Check for sessions
if(isset($_SESSION["username"]))
{
$nav_pages = '
    <ul class="nav navbar-nav navbar-right">
	  <li><a href="?act=home" style=width:85px;>' . $_SESSION['username'] . '</a></li>
      <li style="padding-top:8px; width:60px;"><a href="" class="dropdown dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a>
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