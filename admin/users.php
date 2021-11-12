<?php
include 'include/functions.php';
include 'include/connect.php';
checkSession();
$user = currentuser($conn,$_SESSION['user_id']);// this Function Return a Assoc Array of Current User
if($user['role']!='superadmin'){
    header("Location: dashboard.php");
    $_SESSION['error'] = "You Do Not have Permission to Access this Page";
}
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = strip_tags(trim(mysqli_real_escape_string($conn, $_POST["password"])));
    $password = password_hash($password,PASSWORD_DEFAULT);
    $role = $_POST['role'];
    if(!isset($_GET['edit'])){ 
        $sql = "INSERT INTO $webUser(username,email,password,role)VALUES('$username','$email','$password','$role')";
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From:" . 'Home Appliances' . '<' . $email . ">\r\n";

        $body  = "Hello ".$username.",\r\n";
        $body.="You have to access and Permission of ".$host." as ".$role."\r\n";
        $body.=" Use Your Email and Password to Login \r\n";
        $body.="Email : ".$email."\r\n";
        $body.="Password : ".$_POST['password'];
        if (mail($email, 'New User Permission', $body, $headers)) echo '<div class="alert alert-success text-center"><strong> New Password Sent to Registered Email...</strong></div>';
    }else{
        $id = $_GET['edit'];
        $sql = "UPDATE $webUser SET username='$username',email='$email',role='$role' WHERE id='$id'";
    }
    $result = mysqli_query($conn,$sql);
    header("Location: users.php");
}

if(isset($_GET['delete'])){
    $id= $_GET['delete'];
    $sqlcheckadmin = "SELECT role FROM $webUser WHERE id='$id' AND role='superadmin'";
    $check = mysqli_query($conn,$sqlcheckadmin);
    if(mysqli_num_rows($check)>0){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style=" position: fixed; top: 20%;right: 2%;z-index:9999;"><strong style="margin-right: 25px;">Do Not have Permission To Delete Superadmin!</strong><button type="button" class="close" style="padding: 7px 10px;" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
        header("Refresh:3,url='users.php'");
    }else{
        $sqldel = "DELETE FROM $webUser WHERE id='$id'";
        if(mysqli_query($conn,$sqldel)){
            header("Location: users.php");
        }
    }
}

$sql = "SELECT * FROM $webUser WHERE NOT role='superadmin'";
$result = mysqli_query($conn,$sql);

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $edit = "SELECT * FROM $webUser WHERE id='$id'";
    $hitquery = mysqli_query($conn,$edit);
    $row = mysqli_fetch_assoc($hitquery);
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Users - Khaintan Orfin</title>
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
                <div class="container-fluid mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Users</h4>
                            <div id="accordion3" class="according accordion-s3">
                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#accordion31" aria-expanded="false">Add User</a>
                                    </div>
                                    <div id="accordion31" class="collapse <?php if(isset($_GET['edit'])){echo 'show';}?>" data-parent="#accordion3">
                                        <div class="card-body">
                                            <h4 class="header-title">Add New User</h4>
                                            <form action="" method="POST" role="form">
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" name="username" value="<?php if(isset($_GET['edit'])){ echo $row['username'];}?>" class="form-control" required id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Name">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <input type="email" name="email" value="<?php if(isset($_GET['edit'])){ echo $row['email'];}?>" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3 input-group">
                                                        <input type="password" name='password' class="form-control" <?php if(isset($_GET['edit'])){ echo "disabled value='***************'";}?>  required id="password" placeholder="Password">
                                                        <?php if(!isset($_GET['edit'])){?>
                                                        <div class="input-group-append" data-toggle="tooltip" data-placement="top" title="Show Password" style="cursor:pointer;" onclick="showpass()">
                                                            <span class="input-group-text"><i class="fa fa-eye" id="passicon"></i></span>
                                                        </div>
                                                        <div class="input-group-append" data-toggle="tooltip" data-placement="top" title="Generate Password" style="cursor:pointer;" onclick="generatepass()">
                                                            <span class="input-group-text"><span class="ti-settings"></span></span>
                                                        </div>
                                                        <?php }?>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <select name="role" id="" class="form-control" required>
                                                            
                                                            <option value="admin" <?php if(isset($_GET['edit'])&&$row['role']=='admin-2'){ echo 'selected';}?>>Admin</option>
                                                            <option value="manage_product" <?php if(isset($_GET['edit'])&&$row['role']=='manage_product'){ echo 'selected';}?>>Manage Products</option>
                                                            <option value="manage_enquiry" <?php if(isset($_GET['edit'])&&$row['role']=='manage_enquiry'){ echo 'selected';}?>>Manage Enquiry</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#accordion32" aria-expanded="false">Users Table</a>
                                    </div>
                                    <div id="accordion32" class="collapse <?php if(!isset($_GET['edit'])){echo 'show';}?>" data-parent="#accordion3">
                                        <div class="card-body">
                                            <h4 class="header-title">Website Users</h4>
                                            <div class="single-table">
                                                <div class="table-responsive">
                                                    <table class="table text-center">
                                                        <thead class="text-uppercase bg-secondary">
                                                            <tr class="text-white">
                                                                <th scope="col">ID</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Email</th>
                                                                <th scope="col">Password</th>
                                                                <th scope="col">Role</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php   $i=1;
                                                        while($row = mysqli_fetch_assoc($result)) { ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $i; ?></th>
                                                                <td><?php echo $row['username']; ?></td>
                                                                <td><?php echo $row['email']; ?></td>
                                                                <td>**********</td>
                                                                <td><?php echo $row['role']; ?></td>
                                                                <td>
                                                                    <a href="?edit=<?php echo $row['id']; ?>" ><i class="ti-pencil-alt text-success mr-3"></i></a>
                                                                    <a href="?delete=<?php echo $row['id']; ?>" onclick="if(confirm('Do You want to Delete this User')){return true}else{return false}"><i class="ti-trash text-danger"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php $i++; }?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <footer>
            <div class="footer-area">
                <p>Powered By: <a href="https://www.maxfizz.com" target="_blank">MaxFizz</a></p>
            </div>
        </footer>
        
    </div>
    
    <?php include "include/footer.php" ?>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.status', function(e) {
                e.preventDefault();
                var inner = $(this);
                var id = $(this).attr('data-id');
                var table = $(this).attr('data-table');
                var operation = $(this).attr('data-op');
                $.ajax({
                    url: 'ajax.php',
                    type: 'POST',
                    data: {
                        operation: 'status',
                        status: operation,
                        table: table,
                        id: id
                    },
                    success: function(data) {
                        if (data == 'Active') {
                            inner.html('Active');
                            inner.addClass('text-success');
                            inner.removeClass('text-danger');
                            inner.attr('data-op', 'Deactive');
                        } else {
                            inner.html('Deactive');
                            inner.removeClass('text-success');
                            inner.addClass('text-danger');
                            inner.attr('data-op', 'Active');
                        }
                    }
                });
            });

        });
        function generatepass() {
            const values = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ$%&*#@';
            let passlength = 15;
            let pass='';
            for(let i=0;i<=passlength;i++){
                pass+= values[Math.floor(Math.random()*((values.length-1)-0)+0)];
            }
            $('#password').val(pass);
        }
        function showpass() {
            if($('#password').attr('type')=='text'){
                $('#password').attr('type','password');
                $('#passicon').addClass('fa-eye');
                $('#passicon').removeClass('fa-eye-slash');
            }else if($('#password').attr('type')=='password'){
                $('#password').attr('type','text');
                $('#passicon').addClass('fa-eye-slash');
                $('#passicon').removeClass('fa-eye');
            }
        }
    </script>
</body>

</html>