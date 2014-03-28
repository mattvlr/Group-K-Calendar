<?php 
//Check for sessions
if(isset($_SESSION["first_name"]) && isset($_SESSION["last_name"]))
{
//$introduction = ", " . $first_name . " " . $last_name;
$nav_pages ='<li><a href="?act=home">Home</a></li>
            <li><a href="?act=help">Help</a></li>
            <li><a href="?act=FAQ">FAQ</a></li>
            <li><a href="?act=groups">Groups</a></li>
            <li><a href="?act=logout">Logout</a></li>
			<li><a href="?act=settings">'. $_SESSION['username'] .'</a></li>';
}
else
{
//$introduction = " to team K's Scheduler";
$nav_pages ='<li><a href="?act=home">Home</a></li>
            <li><a href="?act=help">Help</a></li>
            <li><a href="?act=FAQ">FAQ</a></li>
            <li><a href="?act=register">Register</a></li>
            <li><a href="?act=login">Login</a></li>';
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
          <a class="navbar-brand" href="#"><font size="10">K</font>alendar</a>
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

echo $navbar;
?>