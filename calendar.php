<?php
include('connect.php');
$sql = 'SELECT * FROM posts ORDER BY date1;';
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result); 
if($count>0){
    while($row = $result->fetch_assoc()){
        echo '
        <div class="container col-sm-8">    
            <div class="card blog-card">
                <div class="card-body">
                    <div class="blog-header">
                        <h3>'.$row['id'].'</h3>
                    </div>
                    <div class="blog-info">
                        <p class="posted-on"> <i> Posted by '.$row['username'].' on '.$row['date1'].'</i> </p>
                        <p class="card-text">'.$row['dest'].' '.$row['descrp'].'</p>
                    </div>
                </div>
            </div>
        </div>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Calendar</title>
	<link rel="stylesheet" type="text/css" href="calendar.css">
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

	<div id="main-container">
		<div class="cal-head">
			<div class="head-text">
				<a id="left" href="#">left</a>
				<span>&nbsp;</span>
				<span id="month"></span>
				<span>&nbsp;</span>
				<span id="year"></span>
				<a id="right" href="#">right</a>
			</div>
		</div>
		<div class="row">
			<div>
				<table id="table"></table>
			</div>			
		</div>
	</div>
	

	<script type="text/javascript">
		var tabl = document.getElementById("table");
    var month = document.getElementById("month");
    var year = document.getElementById("year");
    
    var left = document.getElementById("left");
    var right = document.getElementById("right");

  var currentDate = new Date();
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
          cal[i].push('<td>' + details.weekDays[j] + '</td>');
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
    })
	});

	tdday.forEach(tdd => {
    tdd.addEventListener('mouseout',function() {
      tdd.classList.remove('hovr');
    })
	});
    
  }

  left.addEventListener('click', function() {
    tabl.innerHTML += '';
    if (currentDate.getMonth() === 0) {
      currentDate = new Date(currentDate.getFullYear() - 1, 11);
      generateCalendar(currentDate);
    } else {
      currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1)
      generateCalendar(currentDate);
    }
  });
  right.addEventListener('click', function() {
    tabl.innerHTML += '<tr></tr>';
    if (currentDate.getMonth() === 11) {
      currentDate = new Date(currentDate.getFullYear() + 1, 0);
      generateCalendar(currentDate);
    } else {
      currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1)
      generateCalendar(currentDate);
    }
  });
  generateCalendar(currentDate);
	</script>
</body>
</html>