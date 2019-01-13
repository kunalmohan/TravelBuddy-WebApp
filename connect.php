<?php
$servername = 'localhost';
$user = 'kunal';		//username to access MySQL database
$pass = 'abcd&1927';	//password to access MySQL database
$db = 'project';		//databse name
$conn = new mysqli($servername, $user, $pass, $db);
if($conn->connect_error){
	die("Connection failed:".$conn->connect_error);
}
?>