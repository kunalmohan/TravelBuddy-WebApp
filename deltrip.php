<?php
include('session.php');
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['submit'])){
		if(!empty($_POST['checklist'])){
			$k=0;
			foreach($_POST['checklist'] as $selected){
				$sql2 = "DELETE FROM triplist WHERE id IN('$selected');";
				if(mysqli_query($conn, $sql2)){
					$k = 1;
				}
			}
			if($k == 1){
				echo "<script> alert('Trip(s) Deleted Successfully!'); window.location='managetrips.php'; </script>";
			}
		}
	}
}
?>