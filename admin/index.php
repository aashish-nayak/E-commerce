<?php
// Turn off error reporting
error_reporting(0);
session_start();
if (isset($_SESSION['id'])) { //destroy session(login) if user come back to this page after successfully login
  session_destroy();
}
include_once "include/connect.php";
include_once "include/functions.php";
$ip = getIpAddr();
$ltime = time(); //login time
$try = getTry($ip, $conn);
$maxtry = 5; //number of login attempts
$blocktime = 30; //in minutes
$minutes = timediffmiuntes($ip, time(), $conn);
if ($minutes >= $blocktime) { // Number in minutes to block user for a period | reset the try and time stamp with 0 and current time stamp respectivly
  $sql = "UPDATE $logtry SET ip='$ip', try=0, ltime='$ltime' where ip='$ip'";
  $result = mysqli_query($conn, $sql);
}
?>
<?php // Check if form was submitted:
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
  //Site Key: 6Lc_LKsbAAAAABKKAbFlE9ey26CMomLijvrCsofw
  //Secret Key: 6Lc_LKsbAAAAAKYU85oWouEyyOooKgpmLrX0xES8

  // Build POST request:
  $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
  $recaptcha_secret = '6LeUIrcZAAAAAEmvQnvx0Fnoh3zlY8-rk7EfRf6Y';
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
      $password = $_POST["password"];
      $password = strip_tags(trim(mysqli_real_escape_string($conn, $password)));
      $sql = "SELECT * FROM $webUser WHERE email='$email' ";
      $result = mysqli_query($conn, $sql); 
      $count = mysqli_num_rows($result);
      $userarr = mysqli_fetch_assoc($result);

      if ($count > 0) {
        if(password_verify($password, $userarr['password'])){
          $_SESSION['id'] = 'HJKaf1_H&56(*&^^&';
          $_SESSION['user_id'] = $userarr['id'];
          set_timeout(); //for session expire after some time
          echo '<div class="alert alert-success text-center"><strong> Login Successful! You are Redirecting to Dashboard...</strong></div>';
          header("refresh:3;url=dashboard.php");
        }else{
          echo '<div class="alert alert-success text-center"><strong> Registered Password is Incorrect...</strong></div>';  
          header("refresh:3;url=index.php");
        }
      } else { //login failed
        echo '<div class="alert alert-success text-center"><strong> Registered Email is Incorrect...</strong></div>';
        $findip = findip($ip, $conn); //find ip from talbe $logtry
        if ($findip == 0) { //insert ip and login try if no old ip present and try
          $try = 1;
          $sql = "INSERT INTO $logtry (ip,try,ltime) VALUES('$ip', '$try','$ltime')";
          $result = mysqli_query($conn, $sql);
        } else {
          $try = getTry($ip, $conn);
          $try++;
          $sql = "UPDATE $logtry SET ip='$ip', try='$try', ltime='$ltime' where ip='$ip'";
          $result = mysqli_query($conn, $sql);
        }
        header("refresh:3;url=index.php");
      }
    }
  } else { //for spammer block login form
    // Not verified - show form error
    //May be spam block the try to 5(max)
    if (ipexist($ip, $conn)) {
      $try = getTry($ip, $conn);
      $try++;
      $sql = "UPDATE $logtry SET try='$maxtry', ltime='$ltime' where ip='$ip'";
      $result = mysqli_query($conn, $sql);
    } else {
      $try = 1;
      $sql = "INSERT INTO $logtry (ip,try,ltime) VALUES('$ip', '$maxtry','$ltime')";
      $result = mysqli_query($conn, $sql);
    }
  }
} ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <title>Login - Khaintan Orfin</title>
  <?php include "include/head-links-table.php"; ?>
  <?php include 'include/gcaptcha.php'; ?>
</head>

<body>

  
  <div class="login-area">
    <div class="container">
      <div class="login-box ptb--100">
        <form action="" method="post">
          <div class="login-form-head">
            <h4>Login</h4>
            <p>Hello, Sign in and Start Managing your Website from Admin Panel</p>
          </div>
          <?php
          if ($try <= $maxtry) {
          ?>
            <div class="login-form-body">
              <div class="form-gp">
                <label for="emailID">Email address</label>
                <input type="email" name="email" required id="emailID">
                <i class="ti-email"></i>
                <div class="text-danger"></div>
              </div>
              <div class="form-gp">
                <label for="passwordID">Password</label>
                <input type="password" name="password" required id="passwordID">
                <i class="ti-lock"></i>
                <div class="text-danger"></div>
              </div>
            <?php } else {
            echo 'Too Many Login Attemps or You are a Spammer! Your Login is Blocked for 30 minutes. Wait or Try Forgot Password...';
          }
            ?>
            <div class="submit-btn-area">
              <button type="submit" value="Submit" name="submit" style="background-color:#2c71da;color:white;font-weight:800;">Submit <i class="ti-arrow-right"></i></button>
              <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
            </div>

            <div class="form-footer text-center mt-5">
              <p class="text-muted"><a href="forgot-password.php">Forgot Password?</a></p>
            </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  

  <?php include"include/footer.php" ?>
</body>

</html>