<?php
include("connect.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']); 
 
      $sql = "SELECT id FROM login WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      if($count == 1) {
        $_SESSION['login_user'] = $username;
        header("location: user.php");
      }else {
        $_SESSION['error'] = "Invalid Username/Password!";
        header("location: login.php");
      }
   }
?>