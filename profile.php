<?php
include("session.php");
$datedel = date("Y-m-d");
$sqldel = "DELETE FROM triplist WHERE tripdate<'$datedel';";
mysqli_query($conn, $sqldel);
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$fname = mysqli_real_escape_string($conn,$_POST['first-name']);
	$lname = mysqli_real_escape_string($conn,$_POST['last-name']);
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$number = mysqli_real_escape_string($conn,$_POST['number']);
	$gender = mysqli_real_escape_string($conn,$_POST['gender']);
	$dob = mysqli_real_escape_string($conn,$_POST['dob']);
    $username = $_SESSION['login_user'];
    
    $sql = "UPDATE members SET fname='$fname', lname='$lname', email='$email', mobileno='$number', dobirth='$dob', gender='$gender' WHERE username = '$username'";
   	if(mysqli_query($conn, $sql)){
   		echo '<script> alert("Profile Updated Successfully!"); window.location="profile.php";</script>';
   	}
}

$username = $_SESSION['login_user'];
$sql3 = "SELECT * FROM members WHERE username='$username';";
$result3 = mysqli_query($conn, $sql3);
$row = mysqli_fetch_array($result3,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile|TravelBuddy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Alegreya SC' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
	<div class="bar">
		<div class="logo">
			<a href="home.php">TravelBuddy</a>
		</div>
		<ul class="nav">
			<li><a href="home.php">HOME</a></li>
			<li><a href="calendar.php">CALENDER</a></li>
			<li id="tologin" class="tologin"><a href="login.php">LOGIN</a></li>
			<li id="loggedin" class="loggedin"><i class="fa fa-user"></i> <?php echo $_SESSION['login_user']; ?> <i class="fa fa-caret-down"></i>
			<div class="drop">
				<a href="profile.php">My Profile</a>
				<a href="managetrips.php">Manage Trips</a>
				<a href="logout.php">Logout</a>
			</div></li>
		</ul>
		<div class="topnav">
				<a href="javascript:void(0);" class="icon" onclick="showMenu()">
				  <i class="fa fa-bars"></i>
				</a>
				<div id="links">
					<div><a href="home.php">HOME</a></div>
					<div><a href="calendar.php">CALENDAR</a></div>
					<div id="tologin1" class="tologin"><a href="login.php">LOGIN</a></div>
					<div id="loggedin1" class="loggedin"><i class="fa fa-user"></i> <?php echo $_SESSION['login_user']; ?></div>
					<div class="loggedin drop1"><a href="profile.php">My Profile</a></div>
					<div class="loggedin drop1"><a href="managetrips.php">Manage Trips</a></div>
					<div class="loggedin drop1"><a href="logout.php">Logout</a></div>
				</div>
			</div>
	</div>

	<div class="panel">
		<i class="fa fa-user fauser"></i>
		<div id="usernm"><?php echo $row['fname'].' '.$row['lname']; ?></div>
		<div><a href="managetrips.php">Manage Trips</a></div>
		<div><a href="logout.php">Logout</a></div>
	</div>
	<div class="main">
		<h1>My Profile</h1>
		<div class="forms">
			<form method="POST" class="form1" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<div class="inp ftname">
					First Name*: <input type="text" name="first-name" class="disable" value="<?php echo $row['fname']; ?>" required disabled>
				</div>
				<div class="inp ltname">
					Last name*: <input type="text" name="last-name" class="disable" value="<?php echo $row['lname']; ?>" required disabled>
				</div>
				<div class="inp gen"><div>Gender*:</div>
					<input type="radio" name="gender" class="disable" value="Male" required disabled><div>Male</div>
					<input type="radio" name="gender" class="disable" value="Female" required disabled><div>Female</div>
					<input type="radio" name="gender" class="disable" value="Other" required disabled><div>Other</div>
				</div>
				<div class="inp">
					<span>Date of Birth*: </span><input type="date" name="dob" class="disable" value="<?php echo $row['dobirth'] ;?>" required disabled>
				</div>
				<div class="inp email">
					E-mail*: <input type="text" name="email" class="disable" value="<?php echo $row['email']; ?>" required disabled>
				</div>
				<div class="inp mobno">
					Mobile No.:<input type="tel" name="number" class="disable" value="<?php echo $row['mobileno']; ?>" disabled>
				</div>
				<div class="inp usname">
					Username*: <input type="username" name="username" placeholder="Username" value="<?php echo $username; ?>" disabled>
				</div>
				<center class="buttons">
					<input class="inp disable" type="submit" name="submit" disabled>
					<input class="inp" type="button" id="edit" name="edit" value="Edit">
				</center>
			</form>
			<form method="POST" class="form2" action="resetpass.php">
				<h2>Change Password</h2>
				<div class="error"><?php echo $_SESSION['error2']; ?></div>
				<div class="inp oldpass">
					Old Password: <input type="password" name="oldpass" required>
				</div>
				<div class="inp newpass">
					New Password: <input type="password" name="newpass" required>
				</div>
				<center><input type="submit" name="submit1"></center>
			</form>
		</div>
	</div>

	<script type="text/javascript">
		let edit = document.getElementById("edit");
		edit.addEventListener('click', function() {
			let disabl = document.getElementsByClassName('disable');
			let disabledElements = Array.from(disabl);
			disabledElements.forEach(dis => dis.disabled=false);
		});
		let gen = document.getElementsByName('gender');
		gen.forEach(g =>{
			if(g.value == "<?php echo $row['gender']; ?>"){
				g.checked=true;
			}
		});
		var user = <?php echo json_encode($_SESSION['login_user']); ?>;
		if(!(user == null)){
			var tolog = document.querySelectorAll('.tologin');
			tolog.forEach(tolg => {
				tolg.style.display = "none";
			});
			var logged = document.querySelectorAll('.loggedin');
			logged.forEach(log => {
				log.classList.remove('loggedin'); 
			});
		}

		function showMenu() {
		  var menu = document.getElementById("links");
		  if (menu.style.display === "block") {
		    menu.style.display = "none";
		  } else {
		    menu.style.display = "block";
		  }
		}
	</script>
</body>
</html>