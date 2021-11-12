<?php
include_once "include/connect.php";
include_once "include/functions.php";
checkSession();
$user = currentuser($conn,$_SESSION['user_id']);// this Function Return a Assoc Array of Current User
?>
<?php
if (isset($_POST['submit'])) {
  //include'include/dbconnect.php';
  // Get the data from the form
  $email = $_POST["email"];
  $email = strip_tags(trim(mysqli_real_escape_string($conn, $email)));
  $password = $_POST["password"];
  $password = strip_tags(trim(mysqli_real_escape_string($conn, $password)));
  $sql = "SELECT * FROM $webUser WHERE email='$email'";
  $result = mysqli_query($conn, $sql); //fire query to the mysql DB
  $count = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  if ($count > 0) {
    if($email==$user['email']){
      if(password_verify($password, $row['password'])){
      $npassword = $_POST['npassword'];
      $hashpassword = password_hash(strip_tags(trim(mysqli_real_escape_string($conn, $npassword))),PASSWORD_DEFAULT);
      $cpassword = $_POST['cpassword'];
      if (($npassword == $cpassword) && $npassword != '') //new password and confirm password are same/ then update the old password with newone
      {
        $sql =  "UPDATE `$webUser` SET `password` = '$hashpassword' WHERE email='$email'";
        $result = mysqli_query($conn, $sql); //fire query to the mysql DB
        if ($result) {
          echo '<div class="alert alert-success text-center"><strong> Password Updated Successfully...</strong></div>';
          header("refresh:3;url=dashboard.php");
          //header("Location: index.php");
        }
      } else {
        echo '<div class="alert alert-success text-center"><strong> New Password & Confirm New Password are not Same...</strong></div>';
        header("refresh:3;url=change-password.php");
      }
      //header("Location: change-password.php");
    }else{
      echo '<div class="alert alert-success text-center"><strong> Registered Old Password is Not Correct...</strong></div>';
    header("refresh:3;url=change-password.php");
    }
    }else{
      echo '<div class="alert alert-success text-center"><strong> Please Enter Only You Email and Password...</strong></div>';
      header("refresh:3;url=change-password.php");
    }
  } else {
    echo '<div class="alert alert-success text-center"><strong> Registered Email is Not Correct...</strong></div>';
    header("refresh:3;url=change-password.php");
    //header("Location: change-password.php");
  }
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Change Password - Khaintan Orfin</title>
    <?php include "include/head-links.php"; ?>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    
    
    <div class="page-container">
        <?php include "include/sidebar.php" ?>
        
        <div class="main-content">
            <?php include "include/header-area.php" ?>
            <div class="main-content-inner">
                <h5 style="text-align:center; margin-top:20px;">Change Password</h5>
                <form style="margin-top:30px" action="" method="post" enctype="multipart/form-data">

                    <div class="col-md-6 offset-md-3 col-xs-12 divpad">
                        <label for="first-name"><b>Email</b> <span class="required">*</span></label>
                        <input type="text" name="email" required="required" class="form-control ">
                    </div>

                    <div class="col-md-6 offset-md-3 col-xs-12 divpad">
                        <label for="first-name"><b>Old Password</b> <span class="required">*</span></label>
                        <input type="password" name="password" required="required" class="form-control ">
                    </div>

                    <div class="col-md-6 offset-md-3 col-xs-12 divpad">
                        <label for="first-name"><b>New Password</b> <span class="required">*</span></label>
                        <input type="password" name="npassword" required="required" class="form-control ">
                    </div>

                    <div class="col-md-6 offset-md-3 col-xs-12 divpad">
                        <label for="first-name"><b>Confirm Password</b> <span class="required">*</span></label>
                        <input type="password" name="cpassword" required="required" class="form-control ">
                    </div>

                    <div class="col-md-6 offset-md-3 mt-4 col-xs-12 divpad">
                        <input type="submit" name="submit" value="Submit" class="btn btn-lg btn-round btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <footer>
            <div class="footer-area">
                <p>Powered By: <a href="https://www.maxfizz.com" target="_blank">MaxFizz</a></p>
            </div>
        </footer>
        
    </div>
    
    <?php include "include/footer.php" ?>
</body>

</html>