<?php
include("session.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = $_SESSION['login_user'];
	$pass1 = mysqli_real_escape_string($conn,$_POST['oldpass']);
	$pass2 = mysqli_real_escape_string($conn,$_POST['newpass']);
	$sql = "SELECT * FROM members WHERE username = '$username' and password = '$pass1';";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count == 1) {
    	$sql1 = "UPDATE members SET password='$pass2' WHERE username='$username';";
    	if(mysqli_query($conn, $sql1)){
    	$_SESSION['error2'] = NULL;
   		echo '<script> alert("Password Updated Successfully!"); window.location="profile.php";</script>';
   	    }
        else{
            echo "Password could not be updated".mysqli_error($sql1);
        }
    }else {
    	$_SESSION['error2'] = "Invalid Old Password!";
    	header("location: profile.php");
    }
}
?>