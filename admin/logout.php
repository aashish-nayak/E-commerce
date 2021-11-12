<?php
  // Turn off error reporting
  error_reporting(0);
  include_once "include/connect.php";
  include_once "include/functions.php";
  checkSession();
  $user = currentuser($conn,$_SESSION['user_id']);// this Function Return a Assoc Array of Current User
  $maxtry = 5;//number of login attempts
  $ip = getIpAddr();
  $try = getTry($ip,$conn);
  if($try<=$maxtry){
    $sql = "DELETE from $logtry WHERE ip='$ip'";
    $result = mysqli_query($conn, $sql);
  }
  if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) {
  echo '<div style="background-color: #dff0d8;color: #3c763d;text-align:center;padding:15px;margin:0px;"><strong> Session Timed Out Login Again...</strong></div>';
  }
  else{
    echo '<div style="background-color: #dff0d8;color: #3c763d;text-align:center;padding:15px;margin:0px;"><strong> You are successfully logged out...</strong></div>';
  }
  session_destroy();
  header( "refresh:3;url=index.php");
?>
<html>
  <head>
    <title>Logout</title>
  </head>
</html>
