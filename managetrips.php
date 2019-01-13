<?php
include ("session.php");
$datedel = date("Y-m-d");
$sqldel = "DELETE FROM triplist WHERE tripdate<'$datedel';";
mysqli_query($conn, $sqldel);
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Trips|TravelBuddy</title>
	<link rel="stylesheet" type="text/css" href="managetrips.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Alegreya SC' rel='stylesheet'>
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
	<div class="main">
		<div class="sect1">
			<h1>Add Trips</h1>
			<form action="add.php" method="POST" class="addevnt">
				<div>Destination: <input type="text" name="destination" required></div>
				<div>Date of departure: <input type="date" name="tripdate" required></div>
				<div class="descr"><div><div>Description: </div><div>(optional) </div></div> <textarea rows="3" name="descrp"></textarea></div>
				<input type="hidden" name="username" value="<?php echo $_SESSION['login_user']; ?>">
				<center><input type="submit" name="submit"></center>
			</form>
		</div>
		<div class="sect2">
			<h1>My Trips</h1>
			<div class="mytrip">
			<?php
			$username1 = $_SESSION['login_user'];
			$sql3 = "SELECT triplist.username, dest, descrp, tripdate, fname, lname FROM triplist LEFT JOIN members ON members.username=triplist.username WHERE triplist.username='$username1' ORDER BY tripdate;";
			$result3 = mysqli_query($conn, $sql3);
			$count3 = mysqli_num_rows($result3);
			if($count3>0){
 				$i = 0;
 				while($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)){
 					if($i == 0) echo '<div class="trip-date"><i class="fa fa-arrow-right"></i>'.$row3['tripdate'].'</div>';
    				else if($row3['tripdate'] != $dateprev) echo '<div class="trip-date"><i class="fa fa-arrow-right"></i>'.$row3['tripdate'].'</div>';
   					echo '
    				<div class="trip-item">
        				<span id="check"><i class="fa fa-caret-right"></i></span>
    				    <span class="user-info">
   						    <span class="userin"> <b>'.$row3['dest'].'</b> </span>
        					<span class="description"> - '.$row3['descrp'].'</span>
       					</span>
    				</div>';
    				$i++;
   					$dateprev = $row3['tripdate'];
 				}
			}
			else{
				echo "<div>You have not planned any future trips.</div>";
			}
			?>
			</div>
		</div>
		<div class="sect3">
			<h1>Delete Trips</h1>
			<form action="deltrip.php" method="POST" class="deltrips">
				<div class="deltrip">
					<?php
					$sql4 = "SELECT triplist.username, triplist.id, dest, descrp, tripdate, fname, lname FROM triplist LEFT JOIN members ON members.username=triplist.username WHERE triplist.username='$username1' ORDER BY tripdate;";
					$result4 = mysqli_query($conn, $sql4);
					$count4 = mysqli_num_rows($result4);
					if($count4>0){
						$i=0;
					    while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
				    		$id = $row4['id'];
				   			if($i == 0) echo '<div class="trip-date"><i class="fa fa-arrow-right"></i>'.$row4['tripdate'].'</div>';
	    					else if($row4['tripdate'] != $dateprev) echo '<div class="trip-date"><i class="fa fa-arrow-right"></i>'.$row4['tripdate'].'</div>';
	    					echo '
	   						<div class="trip-item">
	   						    <span id="check"><input type="checkbox" class="checkbox" name="checklist[]" value="'.$id.'"><b></span>
	  						    <span class="user-info">
	        						<span class="userin"> <b>'.$row4['dest'].'</b> </span>
	    						    <span class="description"> - '.$row4['descrp'].'</span>
	       						</span>
	    					</div>';
	   						$i++;
	    					$dateprev = $row4['tripdate'];
					    }
					    echo '</div><center><input id="dlt" type="submit" name="submit" value="Delete" disabled></center>';
					}
					else{
						echo "<div>You have not planned any future trips.</div>";
					}
					?>
				</div>
			</form>
		</div>
	</div>
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
		var count = 0;
		var dlt = document.getElementById('dlt');
		var checklist = document.getElementsByName('checklist[]');
		checklist.forEach(check => {
			check.addEventListener('change', function(){
				if(check.checked == true){
					count++;
					console.log(count);
					dlt.disabled = false;
				}
			});
		});
		checklist.forEach(check => {
			check.addEventListener('click', function(){
				if(check.checked == false){
					count--;
					console.log(count);
					if(count == 0){
						dlt.disabled = true;
					}
				}
			});
		});

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