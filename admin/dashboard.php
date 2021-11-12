<?php
include 'include/functions.php';
include 'include/connect.php';
checkSession();
$user = currentuser($conn, $_SESSION['user_id']); // this Function Return a Assoc Array of Current User
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Dashboard - Khaintan Orfin</title>
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
                <div class="container p-3">
                    <div class="row justify-content-center">
                        <h1>Welcome To Dashboard</h1>
                    </div>
                    <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show"  role="alert" style=" position: fixed; top: 20%;right: 2%;z-index:9999;"><strong style="margin-right: 25px;">' . $_SESSION['error'] . '</strong><button type="button" class="close" style="padding: 7px 10px;" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
                        $_SESSION['error'] = '';
                    } ?>
                </div>
                <?php if ($user['role'] == 'superadmin' || $user['role'] == 'admin' || $user['role'] == 'manage_product') { ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Latest Categories</h4>
                                    <div class="letest-news mt-4">
                                        <a href="add-cat.php"
                                            class="single-post text-center mb-xs-40 mb-sm-40 d-flex justify-content-center align-items-center"
                                            style="height:100px;width:100%;border-radius:5px;border: 2px dashed green;">
                                            <i class="ti-plus text-success col-12" style="font-size: 40px;"></i>
                                            <p class="m-0 text-muted col-12 font-weight-bold">Add Category</p>
                                        </a>
                                        <?php $sqldash = "SELECT * FROM $catTB ORDER BY cat_order DESC LIMIT 4";
                                            $resultdash = mysqli_query($conn, $sqldash);
                                            while ($rowdash = mysqli_fetch_assoc($resultdash)) { ?>
                                        <div class="single-post mb-xs-40 mb-sm-40">
                                            <div class="lts-thumb">
                                                <img src="uploads/<?php echo $rowdash['main_img']; ?>"
                                                    style="width:100%;border-radius:5px;height:90px;object-fit:contain;"
                                                    alt="post thumb">
                                            </div>
                                            <div class="lts-content">
                                                <h2><a href="add-cat.php?edit=<?php echo $rowdash['id']; ?>"
                                                        data-toggle="tooltip" data-placement="bottom"
                                                        title="Edit"><?php echo limitstring($rowdash['cat_name'], 8); ?></a>
                                                </h2>
                                                <span><?php if ($rowdash['status'] == 1) {
                                                                    $status = 'Active';
                                                                    $data_op = 'Deactive';
                                                                    $text = 'text-success';
                                                                } else {
                                                                    $status = 'Deactive';
                                                                    $data_op = 'Active';
                                                                    $text = 'text-danger';
                                                                }; ?>
                                                    <a href='' class='status <?php echo $text; ?>' data-table="category"
                                                        data-op='<?php echo $data_op; ?>'
                                                        data-id='<?php echo $rowdash['id']; ?>'><?php echo $status; ?></a>
                                                </span>
                                            </div>
                                        </div>
                                        <?php }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 mt-md-30 mt-xs-30 mt-sm-30">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Latest Products</h4>
                                    <div class="letest-news mt-4">
                                        <a href="add-page.php"
                                            class="single-post text-center mb-xs-40 mb-sm-40 d-flex justify-content-center align-items-center"
                                            style="height:100px;width:100%;border-radius:5px;border: 2px dashed green;">
                                            <i class="ti-plus text-success col-12" style="font-size: 40px;"></i>
                                            <p class="m-0 text-muted col-12 font-weight-bold">Add Product</p>
                                        </a>
                                        <?php $sqldash2 = "SELECT * FROM $page ORDER BY page_order DESC LIMIT 4";
                                            $resultdash2 = mysqli_query($conn, $sqldash2);
                                            while ($dashrow = mysqli_fetch_assoc($resultdash2)) {
                                                $imgdash = "SELECT * FROM  $pageImg Where img_id='{$dashrow['id']}'";
                                                $img = mysqli_fetch_assoc(mysqli_query($conn, $imgdash));
                                            ?>
                                        <div class="single-post mb-xs-40 mb-sm-40">
                                            <div class="lts-thumb">
                                                <img src="uploads/<?php echo $img['img1']; ?>"
                                                    style="width:100%;border-radius:5px;height:90px;object-fit:contain;"
                                                    alt="post thumb">
                                            </div>
                                            <div class="lts-content">
                                                <h2><a href="add-page.php?edit=<?php echo $dashrow['id']; ?>"
                                                        data-toggle="tooltip" data-placement="bottom"
                                                        title="Edit"><?php echo limitstring($dashrow['title'], 8); ?></a>
                                                </h2>
                                                <span><?php if ($dashrow['status'] == 1) {
                                                                    $status = 'Active';
                                                                    $data_op = 'Deactive';
                                                                    $text = 'text-success';
                                                                } else {
                                                                    $status = 'Deactive';
                                                                    $data_op = 'Active';
                                                                    $text = 'text-danger';
                                                                }; ?>
                                                    <a href='' class='status <?php echo $text; ?>'
                                                        data-op='<?php echo $data_op; ?>' data-table="page"
                                                        data-id='<?php echo $dashrow['id']; ?>'><?php echo $status; ?></a>
                                                </span>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                if ($user['role'] == 'superadmin' || $user['role'] == 'admin' || $user['role'] == 'manage_enquiry') { ?>
                    <div class="card mt-5">
                        <div class="card-body">
                            <h4 class="header-title">Yesterday's Enquiries</h4>
                            <div class="single-table">
                                <div class="data-tables">
                                    <table id="enuiqryTable" class="display responsive">
                                        <thead class="text-uppercase bg-secondary">
                                            <tr class="text-white">
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Action</th>
                                                <th scope="col">Enquiry</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $today = date("Y-m-d", strtotime("-2 days"));
                                                $resultQuery =  mysqli_query($conn, "SELECT * FROM enquiry WHERE date = '$today'");
                                                if (mysqli_num_rows($resultQuery) > 0) {
                                                    while ($row = mysqli_fetch_assoc($resultQuery)) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['id']; ?></th>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['phone']; ?></td>
                                                <td><?php echo $row['date']; ?></td>
                                                <td>
                                                    <a href="?edit=<?php echo $row['id']; ?>"><i
                                                            class="ti-pencil-alt text-success mr-3"></i></a>
                                                    <a href="?delete=<?php echo $row['id']; ?>"
                                                        onclick="if(confirm('Do You want to Delete this User')){return true}else{return false}"><i
                                                            class="ti-trash text-danger"></i></a>
                                                </td>
                                                <td><?php echo $row['enquiry']; ?></td>
                                            </tr>
                                            <?php }
                                                } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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
    </script>
</body>

</html>