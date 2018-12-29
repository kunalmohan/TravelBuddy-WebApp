<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
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