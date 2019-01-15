<?php
$servername = 'localhost';
$user = '';		//username to access MySQL database
$pass = '';	//password to access MySQL database
$db = '';		//databse name
$conn = new mysqli($servername, $user, $pass, $db);
if($conn->connect_error){
	die("Connection failed:".$conn->connect_error);
}
?>