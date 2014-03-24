<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'K');
define('DB_DATABASE', 'calendar');
$connection = @mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
$base_url='http://www.youwebsite.com/email_activation/';

if (mysqli_connect_errno()) {  //Check connection
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}
?>