<?php
include("connect.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$fname = mysqli_real_escape_string($conn,$_POST['first-name']);
	$lname = mysqli_real_escape_string($conn,$_POST['last-name']);
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$number = mysqli_real_escape_string($conn,$_POST['number']);
  $gender = mysqli_real_escape_string($conn,$_POST['gender']);
  $dob = mysqli_real_escape_string($conn,$_POST['dob']);
  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $password = mysqli_real_escape_string($conn,$_POST['password']); 
    
  $sql = "SELECT id FROM members WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);
  if($count == 0){
  	$sql1 = "INSERT INTO members (fname, lname, dobirth, gender, email, mobileno, username, password) VALUES ('$fname', '$lname', '$dob', '$gender', '$email', '$number', '$username', '$password')";
   	if(mysqli_query($conn, $sql1)){
   		$_SESSION['login_user'] = $username;
      header("location: profile.php");
   	}
  }
  else{
    $_SESSION['error1'] = "Username already taken!";
    header("location: register.php");
  }
}
?>