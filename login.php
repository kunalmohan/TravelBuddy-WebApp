<?php
session_start();
$datedel = date("Y-m-d");
$sqldel = "DELETE FROM triplist WHERE tripdate<'$datedel';";
mysqli_query($conn, $sqldel);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login|TravelBuddy</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="log">
		<div class="head">LOGIN</div>
		<form method="POST" action="check.php">
			<div class="error"><?php echo $_SESSION['error']; ?></div>
			<input type="username" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<input type="submit" name="submit">
		</form>
		<div class="foot">New User? <a href="register.php">Register here</a></div>
	</div>
</body>
</html>

<?php
unset($_SESSION['error']);
?>