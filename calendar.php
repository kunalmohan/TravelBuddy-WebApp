<?php 
include("session.php");
$datedel = date("Y-m-d");
$sqldel = "DELETE FROM triplist WHERE tripdate<'$datedel';";
mysqli_query($conn, $sqldel);

$usrnam = $_GET['usrname'];
$sql1 = "SELECT * FROM members WHERE username='$usrnam';";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Calendar|TravelBuddy</title>
	<link rel="stylesheet" type="text/css" href="calendar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Allerta Stencil' rel='stylesheet'>
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

	<div id="main-container">
    <center>
		  <div class="cal-head">
        <div class="head-text">
		      <a id="left" href="#"><i class="fa fa-chevron-left"></i></a>
          <span>&nbsp;</span>
          <span id="month"></span>
          <span>&nbsp;</span>
          <span id="year"></span>
          <span>&nbsp;</span>
          <a id="right" href="#"><i class="fa fa-chevron-right"></i></a>
        </div>
		  </div>
		  <div class="row">
        <div>
				  <table id="table" cellspacing="0"></table>
        </div>			
		  </div>
      <input type="button" name="allevent" id="allevent" value="All Trips">
    </center>
	</div>

  <div class="section1">
    <div id="allevents" class="allevents">
      <?php
      $sql = 'SELECT triplist.username, dest, descrp, tripdate, fname, lname FROM triplist LEFT JOIN members ON members.username=triplist.username ORDER BY tripdate;';
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);
      if($count>0){
        $i = 0;
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
          if($i == 0) echo '<div class="trip-date"><i class="fa fa-arrow-right"></i>'.$row['tripdate'].'</div>';
          else if($row['tripdate'] != $dateprev) echo '<div class="trip-date"><i class="fa fa-arrow-right"></i>'.$row['tripdate'].'</div>';
          echo '
          <div class="trip-item">
            <span id="desttn"><i class="fa fa-caret-right"></i>'.$row['dest'].' - </span>
            <span class="user-info">
              <span class="userin" data-user="'.$row['username'].'"> <i>'.$row['fname'].' '.$row['lname'].'</i> </span>
              <span class="description"> - '.$row['descrp'].'</span>
            </span>
          </div>';
          $i++;
          $dateprev = $row['tripdate'];
        }
      }
      ?>
    </div>
    <div id="trip" class="disp">
      <?php
      $dispdate = $_GET['dispdate'];
      $sql5 = "SELECT triplist.username, dest, descrp, tripdate, fname , lname FROM triplist LEFT JOIN members ON members.username=triplist.username WHERE tripdate='$dispdate' ORDER BY tripdate;";
      $result5 = mysqli_query($conn, $sql5);
      $count5 = mysqli_num_rows($result5);
      echo '<div class="trip-date"><i class="fa fa-arrow-right"></i>'.$dispdate.'</div>';
      if($count5 > 0){
        while($row = $result5->fetch_assoc()){
          echo '
          <div class="trip-item">
            <span class="destination">
              <span id="desttn"><i class="fa fa-caret-right"></i>'.$row['dest'].' - </span>
            </span>
            <span class="user-info">
              <span class="userin" data-user="'.$row['username'].'"> <i>'.$row['fname'].' '.$row['lname'].'</i> </span>
              <span class="description"> - '.$row['descrp'].'</span>
            </span>
          </div>';
        }
      }
      else{
        echo "No Trips on this date.";
      }
      ?>
    </div>
  </div>

  <div id="user-modal" class="modal">
    <div class="modal-cont">
      <span><u>User Information</u></span>
      <span class="close">&times;</span>
      <h2><?php echo $row1['fname'].' '.$row1['lname']; ?></h2>
      <h3>(<?php echo $row1['username']; ?>)</h3>
      <div class="info">
        <div>First Name: <span id="fstname"><?php echo $row1['fname']; ?></span></div>
        <div>Last Name: <span id="lstname"><?php echo $row1['lname']; ?></span></div>
        <div>Gender: <span id="gender"><?php echo $row1['gender']; ?></span></div>
        <div>E-mail: <span id="email"><?php echo $row1['email']; ?></span></div>
        <div>Mobile No.: <span id="mobno"><?php echo $row1['mobileno']; ?></span></div>
      </div>
    </div>
  </div>

  <div id="user-modal-login" class="modal">
    <div class="modal-cont">
      Please Login to view User Details.
      <span class="close">&times;</span>
    </div>
  </div>
  
  <script type="text/javascript">
    let datesel = <?php echo json_encode($dispdate); ?>;
    if(!(datesel == null)){
      let allevents = document.getElementById('allevents');
      allevents.classList.add('disp');
      let trip = document.getElementById('trip');
      trip.classList.remove('disp');
    }

    var tabl = document.getElementById("table");
    var month = document.getElementById("month");
    var year = document.getElementById("year");
    
    var left = document.getElementById("left");
    var right = document.getElementById("right");
    var date3;
    if(!(datesel == null)){
      var selDate = new Date(datesel);
      date3 = selDate;
    }else{
      var currentDate = new Date();
      date3 = currentDate;
    }
    generateCalendar(date3);

    function generateCalendar(d) {
      Date.prototype.monthDays = function() {
        var d = new Date(this.getFullYear(), this.getMonth() + 1, 0);
        return d.getDate();
      };
      var details = {
        totalDays: d.monthDays(),
        weekDays: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      };
      var start = new Date(d.getFullYear(), d.getMonth()).getDay();
      var cal = [];
      var day = 1;
      for (var i = 0; i <= 6; i++) {
        cal.push(['<tr>']);
        for (var j = 0; j < 7; j++) {
          if (i === 0) {
            cal[i].push('<td class="weekday">' + details.weekDays[j] + '</td>');
          } else if (day > details.totalDays) {
            cal[i].push('<td>&nbsp;</td>');
          } else {
            if (i === 1 && j < start) {
              cal[i].push('<td>&nbsp;</td>');
            } else {
              cal[i].push('<td class="day">' + day++ + '</td>');
            }
          }
        }
        cal[i].push('</tr>');
      }
      cal = cal.reduce(function(a, b) {
        return a.concat(b);
      }, []).join('');
    
      tabl.innerHTML = '';
      tabl.innerHTML += cal;
      month.innerHTML = details.months[d.getMonth()];
      year.innerHTML = d.getFullYear();
      var tdday = document.querySelectorAll(".day");
      tdday.forEach(tdd => {
        tdd.addEventListener('mouseover', function() {
        tdd.classList.add('hovr');
        });
      });

      tdday.forEach(tdd => {
        tdd.addEventListener('mouseout',function() {
          tdd.classList.remove('hovr');
        })
      });
      tdday.forEach(tdd => {
        tdd.addEventListener('click',function() {
          let allevents = document.getElementById('allevents');
          allevents.classList.add('disp');
          let trip = document.getElementById('trip');
          trip.classList.remove('disp');
          let dat = tdd.textContent;
          let mth = d.getMonth()+1;
          let yr = d.getFullYear();
          let seldate = yr + '-' + mth + '-' + dat;
          window.location.href = "http://localhost/project/calendar.php?dispdate=" + seldate;
        });
      });
    }
  
    let alltrips = document.getElementById('allevent');
    alltrips.addEventListener('click', function(){
      let trip1 = document.getElementById('trip');
      trip1.classList.add('disp');
      let allevents1 = document.getElementById('allevents');
      allevents1.classList.remove('disp');
    });

    left.addEventListener('click', function() {
      tabl.innerHTML += '';
      if (date3.getMonth() === 0) {
        date3 = new Date(date3.getFullYear() - 1, 11);
        generateCalendar(date3);
      } else {
        date3 = new Date(date3.getFullYear(), date3.getMonth() - 1)
        generateCalendar(date3);
      }
    });
    left.addEventListener('click', winSize);
    right.addEventListener('click', function() {
      tabl.innerHTML += '<tr></tr>';
      if (date3.getMonth() === 11) {
        date3 = new Date(date3.getFullYear() + 1, 0);
        generateCalendar(date3);
      } else {
        date3 = new Date(date3.getFullYear(), date3.getMonth() + 1)
        generateCalendar(date3);
      }
    });
    right.addEventListener('click', winSize);
    let usermodal = document.getElementById('user-modal');
    let usermodallogin = document.getElementById('user-modal-login');
    let userinf = document.querySelectorAll(".userin");
    userinf.forEach(usr => {
      usr.addEventListener('click', function(){
        let usrname = usr.getAttribute('data-user');
        if(!(datesel == null)){
          window.location.href = "http://localhost/project/calendar.php?usrname=" + usrname + "&dispdate=" + datesel;
        }else{
          window.location.href = "http://localhost/project/calendar.php?usrname=" + usrname; 
        }
      });
    });
    var close = document.querySelectorAll(".close");
    close.forEach(cls => {
      cls.addEventListener('click', function(){
        usermodal.style.display = "none";
        usermodallogin.style.display = "none";
      });
    });
    
    window.onclick = function(event) {
      if (event.target == usermodal || event.target == usermodallogin) {
        usermodal.style.display = "none";
        usermodallogin.style.display = "none";
      }
    }

    var user = <?php echo json_encode($_SESSION['login_user']); ?>;
    var userinform = <?php echo json_encode($_GET['usrname']); ?>;
    if(!(userinform == null) && !(user == null)){
      usermodal.style.display = "block";
    }
    else if(!(userinform == null)){
      usermodallogin.style.display = "block";
    }

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

    window.addEventListener('resize', winSize);

    function winSize(){
      var width = parseInt(window.innerWidth);
      var sun = document.getElementsByClassName('weekday')[0];
      var mon = document.getElementsByClassName('weekday')[1];
      var tues = document.getElementsByClassName('weekday')[2];
      var wed = document.getElementsByClassName('weekday')[3];
      var thur = document.getElementsByClassName('weekday')[4];
      var fri = document.getElementsByClassName('weekday')[5];
      var sat = document.getElementsByClassName('weekday')[6];
      if(width<800 && width>=600){
        mon.innerHTML="Mon";
        tues.innerHTML="Tues";
        wed.innerHTML="Wed";
        thur.innerHTML="Thurs";
        fri.innerHTML="Fri";
        sat.innerHTML="Sat";
        sun.innerHTML="Sun";
      }
      else if(width<600){
        mon.innerHTML="M";
        tues.innerHTML="T";
        wed.innerHTML="W";
        thur.innerHTML="Th";
        fri.innerHTML="F";
        sat.innerHTML="S";
        sun.innerHTML="S";
      }
      else if(width>=800){
        mon.innerHTML="Monday";
        tues.innerHTML="Tuesday";
        wed.innerHTML="Wednesday";
        thur.innerHTML="Thursday";
        fri.innerHTML="Friday";
        sat.innerHTML="Saturday";
        sun.innerHTML="Sunday";
      }
    }

    winSize();

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