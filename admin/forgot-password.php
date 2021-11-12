<?php
// Turn off error reporting
error_reporting(0);
include 'include/connect.php';
include 'include/functions.php';
session_start();
$ip = getIpAddr();
$ltime = time(); //login time
$try = getTry($ip, $conn);
$maxtry = 5; //number of login attempts
$blocktime = 5; //in minutes
$minutes = timediffmiuntes($ip, time(), $conn);
if ($minutes >= $blocktime) { // Number in minutes to block user for a period | reset the try and time stamp with 0 and current time stamp respectivly
  $sql = "UPDATE logintry SET ip='$ip', try=0, ltime='$ltime' where ip='$ip'";
  $result = mysqli_query($conn, $sql);
}
?>
<?php // Check if form was submitted:
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
  //Site Key: 6Lexih0aAAAAAJKt6WaLmcmd-cR65iOfhWJDVs8X
  //Secret Key: 6Lc_LKsbAAAAAKYU85oWouEyyOooKgpmLrX0xES8

  // Build POST request:
  $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
  $recaptcha_secret = '6Lc_LKsbAAAAAKYU85oWouEyyOooKgpmLrX0xES8';
  $recaptcha_response = $_POST['recaptcha_response'];

  // Make and decode POST request:
  $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
  $recaptcha = json_decode($recaptcha);

  // Take action based on the score returned:
  if ($recaptcha->score >= 0.5) { //score near to 1 for human
    // Verified - send email or send to page after successfully login
    if (isset($_POST['submit'])) {
      // Get the data from the form
      $email = $_POST["email"];
      $email = strip_tags(trim(mysqli_real_escape_string($conn, $email)));
      $sql = "SELECT * FROM $webUser WHERE email='$email'";
      $result = mysqli_query($conn, $sql); //fire query to the mysql DB
      $count = mysqli_num_rows($result);

      if ($count == 1) {
        //echo "login successfully";
        $fpassword = generateStrongPassword();
        $fpasswordmd5 = md5($fpassword);
        //update Password
        $sql = "UPDATE $webUser SET password='$fpasswordmd5' where email='$email'";
        $result = mysqli_query($conn, $sql);
        //update password
        //send password to registered mail
        //Email Headers
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From:" . 'Khandelwal Realtor' . '<' . 'info@khandelwalrealtor.com' . ">\r\n";

        $body  = "<b>New Password: </b> " . $fpassword;

        if (mail($email, 'Forgot Password for Khandelwal Realtor', $body, $headers))
          echo '<div class="alert alert-success text-center"><strong> New Password Sent to Registered Email...</strong></div>';
        //echo $fpassword;
        header("refresh:3;url=index.php");
      } else { //login not matched
        echo '<div class="alert alert-success text-center"><strong> Registered Email Not Exist...</strong></div>';
        $findip = findip($ip, $conn); //find ip from talbe logintry
        if ($findip == 0) { //insert ip and login try if no old ip present and try
          $try = 1;
          $sql = "INSERT INTO logintry (ip,try,ltime) VALUES('$ip', '$try','$ltime')";
          $result = mysqli_query($conn, $sql);
        } else {
          $try = getTry($ip, $conn);
          $try++;
          $sql = "UPDATE logintry SET ip='$ip', try='$try', ltime='$ltime' where ip='$ip'";
          $result = mysqli_query($conn, $sql);
        }
        header("refresh:3;url=forgot-password.php");
      }
    }
  } else { //for spammer block login form
    // Not verified - show form error
    //May be spam block the try to 5(max)
    if (ipexist($ip, $conn)) {
      $try = getTry($ip, $conn);
      $try++;
      $sql = "UPDATE logintry SET try='$maxtry', ltime='$ltime' where ip='$ip'";
      $result = mysqli_query($conn, $sql);
    } else {
      $try = 1;
      $sql = "INSERT INTO logintry (ip,try,ltime) VALUES('$ip', '$maxtry','$ltime')";
      $result = mysqli_query($conn, $sql);
    }
  }
} ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <title>Forgot Password - Khaintan Orfin</title>
  <?php include "include/head-links.php"; ?>
  <?php include 'include/gcaptcha.php'; ?>
</head>

<body>
  
  <div id="preloader">
    <div class="loader"></div>
  </div>
  
  
  <div class="login-area">
    <div class="container">
      <div class="login-box ptb--100">
        <form action="" method="POST">
          <div class="login-form-head">
            <h4>Forgot Password</h4>
            <p>Enter Your Login Email to Get the New Password...</p>
          </div>
          <?php
          if ($try <= $maxtry) {
          ?>
            <div class="login-form-body">
              <div class="form-gp">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" placeholder="Email" required="">
                <i class="ti-email"></i>
                <div class="text-danger"></div>
              </div>
              <div class="submit-btn-area">
                <button type="submit" name="submit" style="background-color:#2c71da;color:white;font-weight:800;">Submit <i class="ti-arrow-right"></i></button>
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
              </div>
            <?php } else {
            echo 'Too Many Login Attemps or You are a Spammer! Your Password Change Request is Blocked for 30 minutes.';
          }
            ?>
            <div class="form-footer text-center mt-5">
              <p class="text-muted"><a href="index.php">Login</a></p>
            </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  

  <?php include "include/footer.php" ?>
</body>

</html>