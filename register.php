<?php
session_start();
$datedel = date("Y-m-d");
$sqldel = "DELETE FROM triplist WHERE tripdate<'$datedel';";
mysqli_query($conn, $sqldel);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register|TravelBuddy</title>
	<link rel="stylesheet" type="text/css" href="CSS/register.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="reg">
		<div class="head">REGISTER</div>
		<form method="POST" action="usercheck.php">
			<input type="text" name="first-name" placeholder="First Name*" required>
			<input type="text" name="last-name" placeholder="Last Name*" required>
			<div class="gen"><div>Gender:</div>
			<input type="radio" name="gender" value="Male" required><div>Male&nbsp;</div>
			<input type="radio" name="gender" value="Female" required><div>Female&nbsp;</div>
			<input type="radio" name="gender" value="Other" required><div>Other&nbsp;</div></div>
			<div><span>Date of Birth: </span><input type="date" name="dob" required></div>
			<input type="email" name="email" placeholder="E-mail*" required>
			<input type="tel" name="number" placeholder="Mobile No.">
			<div class="error"><?php echo $_SESSION['error1']; ?></div>
			<input type="username" name="username" placeholder="Username*" required>
			<input type="password" name="password" placeholder="Password*" required>
			<input type="submit" name="submit">
		</form>
		<div class="foot">Already registered? <a href="login.php">Login here</a></div>
	</div>
</body>
</html>

<?php
unset($_SESSION['error1']);
?>