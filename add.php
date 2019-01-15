<?php
include ("session.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$destination = mysqli_real_escape_string($conn,$_POST['destination']);
	$tripdate = mysqli_real_escape_string($conn,$_POST['tripdate']);
	$descrp = mysqli_real_escape_string($conn,$_POST['descrp']);
	$username = mysqli_real_escape_string($conn,$_POST['username']);;
	$mindate = date("Y-m-d");
	echo $mindate;
	    
    $sql = "INSERT INTO triplist (username, tripdate, dest, descrp) VALUES ('$username', '$tripdate', '$destination', '$descrp')";
   	
   	if(mysqli_query($conn, $sql)){
   		echo "<script> alert('Trip Added Successfully.'); window.location='managetrips.php'; </script>";
   	}

   	else {
   		echo "Could not add Trip:".mysqli_error($sql);
   	}
}
?>