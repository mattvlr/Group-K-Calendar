<?php

//GET USERS SETTINGS FROM DATABASE TO POPULATE FORM

//GENERATE FORM

$form = '	<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '?act=login" method = "post">
			<input type="password" name = "password" class="form-control" placeholder="Password" required>
			<input type="password1" name = "password1" class="form-control" placeholder="Password" required>
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