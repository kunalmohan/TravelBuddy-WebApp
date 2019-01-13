<?php
include('session.php');
$datedel = date("Y-m-d");
$sqldel = "DELETE FROM triplist WHERE tripdate<'$datedel';";
mysqli_query($conn, $sqldel);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home|TravelBuddy</title>
	<link rel="stylesheet" type="text/css" href="home.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Aladin' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Alegreya SC' rel='stylesheet'>
</head>
<body>
	<header>
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
		<div class="main">
			<div class="head">TravelBuddy</div>
			<div class="desc">
				A place where you can find your Perfect Travel Companion,<br>
				So that you no longer have to travel alone.
			</div>
			<input type="button" name="" value="Get Started" onclick="getStarted()">
		</div>
	</header>
	<script type="text/javascript">
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

		function getStarted(){
			if(!(user == null)){
				window.location="profile.php";
			}
			else window.location="register.php";
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