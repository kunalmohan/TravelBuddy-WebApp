<?php
include("session.php");
?>


<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="user.css">
</head>
<body>
Hi <span class="usr"><?php echo $_SESSION['login_user']; ?></span> !
<div><a href="logout.php">Logout</a></div>
<div><a href="addevent.php" title="">Add Trip</a></div>
<div><a href="myevents.php" title="">My Trips</a></div>
</body>
</html>