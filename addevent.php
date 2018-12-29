<?php
include ("session.php");
include("connect.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$destination = mysqli_real_escape_string($conn,$_POST['destination']);
	$tripdate = mysqli_real_escape_string($conn,$_POST['tripdate']);
	$descrp = mysqli_real_escape_string($conn,$_POST['descrp']);
	$username = mysqli_real_escape_string($conn,$_POST['username']);;
	    
    $sql = "INSERT INTO posts (username, date1, dest, descrp) VALUES ('$username', '$tripdate', '$destination', '$descrp')";
   	
   	if(mysqli_query($conn, $sql)){
   		echo "<script> alert('Trip Added Successfully.'); window.location='addevent.php'; </script>";
   	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Trip</title>
	<link rel="stylesheet" type="text/css" href="addevent.css">
</head>
<body>
	<div class="bar">
    	<div class="logo">
    		NAME
    	</div>
    	<ul class="nav">
    		<li><a href="">HOME</a></li>
    		<li><a href="">CALENDER</a></li>
    		<li><a href="login.php">LOGIN</a></li>
		</ul>
	</div>
	<div class="main">
		Hi <span class="usr"><?php echo $_SESSION['login_user']; ?></span> !
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<input type="text" name="destination" required>
			<input type="date" name="tripdate" required>
			<textarea rows="5" name="descrp"></textarea>
			<input type="hidden" name="username" value="<?php echo $_SESSION['login_user']; ?>">
			<input type="submit" name="submit">
		</form>
	</div>
</body>
</html>