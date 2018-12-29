<?php
	$servername = 'localhost';
	$user = 'kunal';
	$pass = 'abcd&1927';
	$db = 'try';
	$k = 1;
	$conn = new mysqli($servername, $user, $pass, $db);
	if($conn->connect_error){
		die("Connection failed:".$conn->connect_error);
	}
?>