<?php 
//Check for sessions
if(isset($_SESSION["first_name"]) && isset($_SESSION["last_name"]))
{
$nav_pages = '
<div class="navbar navbar-fixed-top">
    <ul class="nav navbar-nav navbar-right">
	  <li><a href="?act=home">' . $_SESSION['username'] . '</a></li>
      <li><a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown"><b class="caret" align="left"></b></a>
        <ul class="dropdown-menu">
          <li><a href="?act=settings">Settings</a></li>
          <li><a href="?act=help">Help</a></li>
          <li class="divider"></li>
          <li><a href="?act=logout">Logout</a></li>
        </ul>
      </li>
    </ul>
</div>';
}
else
{
  $nav_pages = '';
}

$navbar = '
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <img src="http://i.imgur.com/pamXbHx.png" style="position:absolute; padding-top:5px; left:-18px;"/>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          ' . $nav_pages . '
          </ul>
        </div>
      </div>
    </div>';

if(isset($_SESSION["first_name"]) && isset($_SESSION["last_name"]))
{
  echo $navbar;
}
?>