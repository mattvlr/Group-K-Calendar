<?php

//GET USERS SETTINGS FROM DATABASE TO POPULATE FORM

//GENERATE FORM

$form = '	
<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '?act=login" method = "post">
			<input type="text" name = "avatar" class="form-control" placeholder="avatarlocation" required><br>
			<input type="text" name = "first" class="form-control" placeholder="first" required><br>
			<input type="text" name = "last" class="form-control" placeholder="last" required><br>
			<input type="password" name = "password" class="form-control" placeholder="Password" required><br>
			<input type="password1" name = "password1" class="form-control" placeholder="Password" required>
			<br><br>
				<div class="form-group">
		  <label for="textArea" class="col-lg-2 control-label">About</label>
		  <div class="col-lg-10">
			<textarea class="form-control" rows="3" id="textArea"></textarea>
			<span class="help-block">Info about you.</span>
		  </div>	
			
			<input type="hidden" name="login" value = "true">
		</label>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Modify Settings</button>
		<br>
		</form>';

?>

<html>
<head>
<title>Settings</title>
	<?php 
		if($_SESSION['theme'] == 1){ 
			echo '<link href="/bootstrap/css/dark.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="dark_template.css">
			<link href="/bootstrap/css/dark_signin.css" rel="stylesheet">'; 
		}
		else { 
			echo '<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="template.css">
			<link href="/bootstrap/css/signin.css" rel="stylesheet">';
		} ?>
</head>
<body><center><h1>Settings</h1></center>
<?php
echo $form;
?>
</div></body></html>