<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
	<div class="reg">
		<div class="head">REGISTER</div>
		<form method="POST" action="usercheck.php">
			<input type="text" name="first-name" placeholder="First Name*" required>
			<input type="text" name="last-name" placeholder="Last Name*" required>
			<input type="email" name="email" placeholder="E-mail*" required>
			<input type="tel" name="number" placeholder="Mobile No.">
			<div class="error"><?php echo $_SESSION['error1']; ?></div>
			<input type="username" name="username" placeholder="Username*" required>
			<input type="password" name="password" placeholder="Password*" required>
			<input type="submit" name="submit">
		</form>
		<div class="foot">Already registered? <a href="login.html">Login here</a></div>
	</div>
</body>
</html>

<?php
unset($_SESSION['error1']);
?>