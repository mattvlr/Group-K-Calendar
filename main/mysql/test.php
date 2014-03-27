<?php
require_once('_db.php');
require_once('_mysql.php');
/*
echo "TESTING THE MYSQL DRIVER<BR>";

$mysql = new mysql_driver;

if($mysql->connect())
{
echo "MYSQL connected!<br>";
}

echo "CHECKING IF THE USER WITH LAST NAME TESTLASNTAME HAS A FIRSTNAME OF TESTFIRSTNAME<BR>";

if($mysql->compare('user','first_name', "testfirstname", "last_name = 'testlastname'"))
{
echo "working<br>";
}
else
{
echo "Not working<br>";
}
setcookie('id', '1', time()+86400);
echo "<br>done";

$things = array(	'username' => 'testusername',
					'first_name' => 'testfirstname',
					'last_name' => 'testlastname',
					'email' => 'test@email.com',
					'passhash' => '1234567890123',
					'salt' => '1234567890123456789012345',
					'dob' => '2014-04-11',
					'activation' => '1234567890123',
					'activated' => 1
				);
//$mysql->insert('user', $things);   //inserts the $things set


$getset = array( 'username','passhash','salt');
$found = '';
$found = $mysql->select('user',$getset,'id=1');

//echo "FOUND : " . $found . "<br>";
print_r($found);
echo '<br>';

$found = $mysql->getSessionInfo($_COOKIE['id']);  // example of loading session info fo user 1 this is used for loading userdata to a session when a cookie is present

print_r($found);
*/

?>