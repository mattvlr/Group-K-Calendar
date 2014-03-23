<?php 
for($i = 0; $i < 50; $i++) {
	$pw = 'groupkAAAAAAAAAAAAAAAAAAAAAA';
	$salt = uniqid(mt_rand(0,61),true);
	echo strlen($salt);
	echo "  :";
	echo $salt;
	echo "  :";
	$pwhash = crypt($pw,$salt);
	echo strlen($pwhash);
	echo "  :";
	echo $pwhash;
	echo '<br>';
	}
	


?>