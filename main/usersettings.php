<?php

//GET USERS SETTINGS FROM DATABASE TO POPULATE FORM

//GENERATE FORM

$form = '	
<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '?act=login" method = "post">
			<input type="text" name = "avatar" class="form-control" placeholder="avatarlocation" required>
			<input type="text" name = "first" class="form-control" placeholder="first" required>
			<input type="text" name = "last" class="form-control" placeholder="last" required>
			<input type="password" name = "password" class="form-control" placeholder="Password" required>
			<input type="password1" name = "password1" class="form-control" placeholder="Password" required>
			
			<div class="form-group">
			  <label for="select" class="col-lg-2 control-label">Theme: </label>
			  <div class="col-lg-10">
				<select class="form-control" id="select">
				  <option>THEME 1</option>
				  <option>THEME 2</option>
				  <option>THEME 3</option>
				</select>
			  </div>
			</div>

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
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/bootstrap/css/signin.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="template.css">
</head>
<body><center><h1>Settings</h1></center>
<?php
echo $form;
?>
</div></body></html>