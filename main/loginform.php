<!DOCTYPE html>
<?php

$form = '';
$status = '';
$rem = '';

if(isset($_COOKIE['wait']))
{
	$status = "You have tried too many times to login. Please wait another " . floor(($_COOKIE["wait"]-time())/60)  . " minutes " . ($_COOKIE["wait"]-time())%60 . " seconds and try again.<br>";
}
if(!isset($_POST['attempts']))
{
 $attempts = 0;
}
else
{
$attempts = 1 + $_POST['attempts'];
}

if(isset($_POST['email']))
{
 $email = 'value="'.$_POST['email'];
}
else
{
 $email = 'placeholder="Email Address';
}
if(isset($_POST['remember']))
{
$rem = 'checked';
}
if(isset($_POST['email']) && isset($_POST['password']))
{
	$id = $mysql->login($_POST['email'],$_POST['password']);
	if($id)
	{ // user logged in
		if(isset($_POST['rem']))
		{
			$time = 172800; // 2 days;
			setcookie('id',$id,time()+$time);  //IM PRETTY SURE ANYONE COULD JUST MAKE A COOKIE WITH THAT ID AND USE IT TO LOGIN, but it works for now...
		}
		$status = "<font color='green'>Login success!</font>";
		$_SESSION = $mysql->getSessionInfo($id);
		$_SESSION['id']= $id;
		header("Location: index.php?act=home");
	}
	else  // not logged in
	{
		$status = "<font color='red'>Login failed!</font>";
		if(!$mysql->exists('user',"email='".$_POST['email']."'"))
		{
			$status = "<font color='red'>Email Dosnt exist!</font>";
		}
	}
}

$form = '	<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '?act=login" method = "post">
			<h1>Welcome to Kalendar.</h1>
			<h2 class="form-signin-heading">Sign in:</h2>
			<br>' . $status . 
			'<input type="email" name = "email" class="form-control" ' . $email . '" required autofocus>
			<input type="password" name = "password" class="form-control" placeholder="Password" required>
			<input type="hidden" name="login" value = "true">
			<input type="hidden" name="attempts" value ="' . $attempts . '">
		<label class="checkbox">
		<input type="checkbox" name = "rem" value="rem"'. $rem .'> Remember me
		</label>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		<br>
		<center>Dont have an account? <a href="?act=register">Register here.</a></center>
		<center><a href="?act=forgot">Forgot Password?</a></center>
		</form>';

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/bootstrap/css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="login">
		<?php echo $form;?>
     <!--<center> Return to the template <a href="template.php">here.</a> </center>-->

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>