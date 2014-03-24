<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php include 'CalendarFunctions.php'; ?>
    <link rel="stylesheet" type="text/css" href="template.css">
    <script src="SidebarJavaScript/SpryMenuBar.js" type="text/javascript"></script>
    <script src="CalendarJsFunctions.js"></script>
    <link href="SidebarJavaScript/SpryMenuBarVertical.css" rel="stylesheet" type="text/css">

    <title>Group K Group Scheduling Calendar</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/bootstrap/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Group Scheduling Calendar - Group K</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="login.php">Logout</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="list-group-item">
              <span class="badge">14</span>
                Messages
            <li class="list-group-item">
               <span class="badge">3</span>
                Upcoming Events
            <li><a href="#">Group Invites</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Month</a></li>
            <li><a href="yeartest.php">Year Test</a></li>
            <li><a href="daytest.php">Day Test</a></li> 
          </ul>
          <?php echo draw_small_month(date("m"),date("Y")); ?>
          <br>
          Check out the login form <a href="login.php">here.</a>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Calendar - <?php echo date("F"), " ", date("Y"); ?></h1>
          <div class="calendar">
            <?php echo draw_calendar(date("m"),date("Y")); ?>
            <br>
          </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/bootstrap/js/docs.min.js"></script>
    <script var MenuBar1 = new Spry.Widget.MenuBar("sidebar", {imgRight:"../SidebarJavaScript/SpryMenuBarRightHover.gif"});>
  </body>
</html>