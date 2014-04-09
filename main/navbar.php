<?php 
//Check for sessions
if(isset($_SESSION["first_name"]) && isset($_SESSION["last_name"]))
{
//$introduction = ", " . $first_name . " " . $last_name;
$nav_pages ='<li><a href="?act=home">'. $_SESSION['username'] .'</a>
            <li><a href="?act=settings">Settings</a></li>
            <li><a href="?act=help">Help</a></li>
            <li><a href="?act=logout">Logout</a></li>';
}
else
{
  $nav_pages = '';
}

$navbar = '<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img src="http://i.imgur.com/FztPKah.png" style="padding-top:5px;padding-left:20px;"/>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          ' . $nav_pages . '
          </ul>
          <form class="navbar-form navbar-right">
          '/*<input type="text" class="form-control" placeholder="Search...">*/.'
          </form>
        </div>
      </div>
    </div>';

if(isset($_SESSION["first_name"]) && isset($_SESSION["last_name"]))
{
  echo $navbar;
}
?>