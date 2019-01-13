<?php
   session_start();
   
   if(session_destroy()) {
   	echo "<script> alert('Successfully Logged Out.'); window.location='home.php'; </script>";
    }
?>