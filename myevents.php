
<!DOCTYPE html>
<html>
<head>
	<title>My Trips</title>
</head>
<body>
	<div class="triplist">
		<?php
include("connect.php");
include("session.php");
$username1 = $_SESSION['login_user'];
echo "Hi $username1!";
$sql = "SELECT * FROM posts WHERE username IN('$username1')";
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
else{
	echo "<div>You have not planned any future trips.</div>";
}
?>

	</div>
	<select class="dellist">
		<?php
include("connect.php");
include("session.php");
$username1 = $_SESSION['login_user'];
echo "Hi $username1!";
$sql = "SELECT * FROM posts WHERE username IN('$username1')";
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
else{
	echo "<div>You have not planned any future trips.</div>";
}
?>

	</select>
</body>
</html>