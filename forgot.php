
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forgot</title>

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
	<script src="functions.js"></script>
  </head>
	<body>
	<?php
include 'db.php';
if(!empty($_GET['code']) && isset($_GET['code']) && $_GET['code'] != '0' )
{
$code=$_GET['code'];
$c=mysqli_query($connection,"SELECT id FROM user WHERE forgot='$code'");

if(mysqli_num_rows($c) > 0)
{
$count=mysqli_query($connection,"SELECT id FROM user WHERE forgot='$code' and activated='0'");

if(mysqli_num_rows($count) == 1)
{
mysqli_query($connection,"UPDATE user SET forgot='0' WHERE activation='$code'");
$body="Your account is activated"; 
}
else
{
$body ="Your account is already active, no need to activate again";
}

}
else if(isset($_GET['code']))
{
$body ="Wrong activation code.";
}
else if ($_GET['code'] != '0')
{
$body = "dont even try";
}
else
{
}
}
$body = '<div class="container">
	<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '" method = "post">
	<h1>Welcome to Group K' . "'" . 's Group Scheduling System.</h1>
	<h2 class="form-signin-heading">Forgot Password?</h2>
	<h3><font color="red" size="3">' . $status . '</font></h3>
	<input type="email" name = "email" class="form-control" placeholder="Email Address" required autofocus>
	<input type="text" name = "username" class="form-control" placeholder="User Name" required>
	<input type="password" name = "password" id = "password" class="form-control" placeholder="New Password" required>
	<input type="password" name = "password1" id = "password1" class="form-control" placeholder="New Password" onkeyup="checkPass(); return false;" required>
	<a id = "confirmMessage"></a>
	<input type="hidden" name="forgot" value = "true">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
	</form>

	<center>Return to the template <a href="template.php">here</a>.</center>
	<center> Already have an account? Login <a href="login.php">here</a>.</center>

	</div> <!-- /container -->';




?>
<?php echo $body; ?>

	</body>
</html>