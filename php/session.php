<?php
   include('db_connection.php');
   session_start();
   
   $user = $_SESSION['email'];

   $ses_sql = mysqli_query($conn,"SELECT email FROM users WHERE email = '$user' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['email'];
   
   if(!isset($_SESSION['email'])){
      header("location:login.php");
      die();
   }
?>