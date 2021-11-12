<?php
include 'include/functions.php';
include 'include/connect.php';
checkSession();
$user = currentuser($conn,$_SESSION['user_id']);// this Function Return a Assoc Array of Current User
if($user['role']=='manage_enquiry' || $user['role']=='manage_product'){
    header("Location: dashboard.php");
    $_SESSION['error'] = "You Do Not have Permission to Access this Page";
}
if(isset($_POST['submit'])){
    $shopname = $_POST['shopname'];
    $distname = $_POST['distname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $whatsapp = $_POST['whatsapp'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    if(!isset($_GET['edit'])){ 
        $sql = "INSERT INTO $dist(shop_name,distri_name,email,phone,whatsapp,address,city)VALUES('$shopname','$distname','$email','$phone','$whatsapp','$address','$city')";
    }else{
        $id = $_GET['edit'];
        $sql = "UPDATE $dist SET shop_name='$shopname', distri_name='$distname', email='$email', phone='$phone', whatsapp='$whatsapp', address='$address', city='$city' WHERE id='$id'";
    }
    $result = mysqli_query($conn,$sql);
    header("Location: distributer.php");
}

if(isset($_GET['delete'])){
    $id= $_GET['delete'];
    $sqldel = "DELETE FROM $dist WHERE id='$id'";
    if(mysqli_query($conn,$sqldel)){
        header("Location: distributer.php");
    }
}

$sql = "SELECT * FROM $dist";
$result = mysqli_query($conn,$sql);

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $edit = "SELECT * FROM $dist WHERE id='$id'";
    $hitquery = mysqli_query($conn,$edit);
    $row = mysqli_fetch_assoc($hitquery);
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Distributer Network - Khaintan Orfin</title>
    <?php include "include/head-links-table.php"; ?>
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
                            <h4 class="header-title">Distributers</h4>
                            <div id="accordion3" class="according accordion-s3">
                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#accordion31"
                                            aria-expanded="false">Add Distributer</a>
                                    </div>
                                    <div id="accordion31"
                                        class="collapse <?php if(isset($_GET['edit'])){echo 'show';}?>"
                                        data-parent="#accordion3">
                                        <div class="card-body">
                                            <h4 class="header-title">Add New Distributer</h4>
                                            <form action="" method="POST" role="form">
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" name="shopname"
                                                            value="<?php if(isset($_GET['edit'])){ echo $row['shop_name'];}?>"
                                                            class="form-control" required placeholder="Shop Name">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" name="distname"
                                                            value="<?php if(isset($_GET['edit'])){ echo $row['distri_name'];}?>"
                                                            class="form-control" required
                                                            placeholder="Distributer Name">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3 input-group">
                                                        <input type="email" name="email"
                                                            value="<?php if(isset($_GET['edit'])){ echo $row['email'];}?>"
                                                            class="form-control" required placeholder="Enter Email">
                                                    </div>
                                                    <div class="col-md-6 mb-3 input-group">
                                                        <input type="tel" name='phone' class="form-control" value="<?php if(isset($_GET['edit'])){ echo $row['phone'];}?>" required placeholder="Enter Phone">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3 input-group">
                                                        <input type="text" name="address"
                                                            value="<?php if(isset($_GET['edit'])){ echo $row['address'];}?>"
                                                            class="form-control" required
                                                            placeholder="Enter Shop Address">
                                                    </div>
                                                    <div class="col-md-6 mb-3 input-group">
                                                        <input type="tel" name='whatsapp' class="form-control" value="<?php if(isset($_GET['edit'])){ echo $row['whatsapp'];}?>"
                                                            required placeholder="Enter Whatsapp Number">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3 input-group">
                                                        <input type="text" class="form-control" name="city" id="" value="<?php if(isset($_GET['edit'])){ echo $row['city'];}?>"
                                                            placeholder="Enter City">
                                                    </div>
                                                </div>
                                                <button type="submit" name="submit"
                                                    class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#accordion32"
                                            aria-expanded="false">Distributers Table</a>
                                    </div>
                                    <div id="accordion32"
                                        class="collapse <?php if(!isset($_GET['edit'])){echo 'show';}?>"
                                        data-parent="#accordion3">
                                        <div class="card-body">
                                            <h4 class="header-title">Distributers</h4>
                                            <div class="data-tables datatable-primary">
                                                <table id="enuiqryTable" class="display responsive">
                                                    <thead class="text-capitalize bg-secondary">
                                                        <tr class="text-white">
                                                            <th>ID</th>
                                                            <th>Shop_Name</th>
                                                            <th>Distributer_Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Whatsapp</th>
                                                            <th>City</th>
                                                            <th>Action</th>
                                                            <th>Address</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                                        <tr>
                                                            <th><?php echo $row['id']; ?></th>
                                                            <td><?php echo $row['shop_name']; ?></td>
                                                            <td><?php echo $row['distri_name']; ?></td>
                                                            <td><?php echo $row['email']; ?></td>
                                                            <td><?php echo $row['phone']; ?></td>
                                                            <td><?php echo $row['whatsapp']; ?></td>
                                                            <td><?php echo $row['city']; ?></td>
                                                            <td>
                                                                <a href="?edit=<?php echo $row['id']; ?>"><i
                                                                        class="ti-pencil-alt text-success mr-3"></i></a>
                                                                <a href="?delete=<?php echo $row['id']; ?>"
                                                                    onclick="if(confirm('Do You want to Delete this User')){return true}else{return false}"><i
                                                                        class="ti-trash text-danger"></i></a>
                                                            </td>
                                                            <td><?php echo $row['address']; ?></td>
                                                        </tr>
                                                        <?php }?>
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
        
        
        <footer>
            <div class="footer-area">
                <p>Powered By: <a href="https://www.maxfizz.com" target="_blank">MaxFizz</a></p>
            </div>
        </footer>
        
    </div>
    
    <?php include "include/footer-table.php" ?>
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
        let pass = '';
        for (let i = 0; i <= passlength; i++) {
            pass += values[Math.floor(Math.random() * ((values.length - 1) - 0) + 0)];
        }
        $('#password').val(pass);
    }

    function showpass() {
        if ($('#password').attr('type') == 'text') {
            $('#password').attr('type', 'password');
            $('#passicon').addClass('fa-eye');
            $('#passicon').removeClass('fa-eye-slash');
        } else if ($('#password').attr('type') == 'password') {
            $('#password').attr('type', 'text');
            $('#passicon').addClass('fa-eye-slash');
            $('#passicon').removeClass('fa-eye');
        }
    }
    </script>
</body>

</html>