<?php
include 'include/connect.php';
include 'include/functions.php';
checkSession();
$user = currentuser($conn, $_SESSION['user_id']); // this Function Return a Assoc Array of Current User
if ($user['role'] == "manage_enquiry") {
    header("Location: dashboard.php");
    $_SESSION['error'] = "You Do Not have Permission to Access this Page";
}
if (isset($_GET['view-sub'])) {
    $cat_url = $_GET['view-sub'];
    $bread = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM $catTB WHERE cat_url='$cat_url'"));
    $cat_id = $bread['id'];
    $back = $bread['parent_id'];
    $cat_name = $bread['cat_name'];
} else {
    $cat_id = 0;
}
$result = mysqli_query($conn, "SELECT * FROM $catTB WHERE parent_id='$cat_id'");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $cat = $_GET['cat_url'];
    $count = countPage($conn, $page, 'cat_type', $cat);
    if ($count > 0) {
        echo "<script>alert('Please Firstly Delete " . $count . " Pages in " . strtoupper($cat) . " Category')</script>";
        header("Refresh:1, url=view-cat.php");
    } else {
        delImg($conn, $catTB, "main_img", 'id', $id);
        delImg($conn, $catTB, "banner_img", 'id', $id);
        mysqli_query($conn, "DELETE FROM $catTB WHERE id='$id'");
        header("Location: view-cat.php");
    }
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>View Category - Khaintan Orfin</title>
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
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="breadcrumbs-area clearfix mb-4">
                                    <h4 class="page-title pull-left col-12">
                                        <?php if (isset($cat_name)) {
                                            echo $cat_name;
                                        } else {
                                            echo "Categories";
                                        } ?>
                                    </h4>
                                    <ul class="breadcrumbs pull-left col-12 mt-4">
                                        <?php if(isset($cat_url)){
                                            echo '<li><a href="view-cat.php">Home</a></li>';
                                            $string = findlevel($conn,$cat_url);
                                            $arr = array_reverse(array_filter(explode(",", $string)));
                                            foreach ($arr as $key => $val) {
                                                if($val==$cat_url){
                                                    echo '<li><span>' . ucwords(str_replace("-", " ", $val)) . '</span></li>';
                                                }else{
                                                    echo '<li><a href="view-cat.php?view-sub='.$val . '">' . ucwords(str_replace("-", " ", $val)) . '</a></li>';
                                                }
                                            }
                                        }
                                        ?>
                                        <!-- <li><span>Dashboard</span></li> -->
                                    </ul>
                                </div>
                                <div class="data-tables datatable-dark">
                                    <table id="dataTable3" class="display responsive nowrap">
                                        <thead class="text-capitalize bg-info">
                                            <tr>
                                                <th>S.no.</th>
                                                <th>Category Name</th>
                                                <th>Order</th>
                                                <th>Parent</th>
                                                <th>Cat_Image</th>
                                                <?php if(!isset($_GET['view-sub'])){?>
                                                <th>Cat_Banner</th>
                                                <th>Site Banner</th>
                                                <?php }?>
                                                <th>Status</th>
                                                <th>Operation</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (mysqli_num_rows($result) > 0) {
                                                $i = 1;
                                                while ($rows = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td><a href="view-cat.php?view-sub=<?php echo $rows['cat_url']; ?>" class="text-dark"><?php echo limitstring($rows['cat_name'], 6); ?></a></td>
                                                        <td><?php echo $rows['cat_order']; ?></td>
                                                        <td><?php $cat = mysqli_fetch_assoc(mysqli_query($conn, "SELECT cat_name FROM $catTB WHERE id='{$rows['parent_id']}'"));
                                                            if (isset($cat['cat_name'])) {
                                                                echo $cat['cat_name'];
                                                            } else {
                                                                echo "Parent";
                                                            }
                                                            ?></td>
                                                        <td><img src="uploads/<?php echo $rows['main_img']; ?>" style="height:60px;width:auto;"></td>
                                                        <?php if(!empty($rows['banner_img'])){
                                                           echo  '<td><img src="uploads/'. $rows['banner_img'].'"style="height:60px;width:auto;"></td>';
                                                        }?>
                                                        <?php if(!empty($rows['site_bann'])){
                                                           echo  '<td><img src="uploads/'. $rows['site_bann'].'"style="height:60px;width:auto;"></td>';
                                                        }?>
                                                        <td><?php
                                                            if ($rows['status'] == 1) {
                                                                $status = 'Active';
                                                                $data_op = 'Deactive';
                                                                $text = 'text-success';
                                                            } else {
                                                                $status = 'Deactive';
                                                                $data_op = 'Active';
                                                                $text = 'text-danger';
                                                            }
                                                            ?>
                                                            <a href='' class='status <?php echo $text; ?>' data-op='<?php echo $data_op; ?>' data-id='<?php echo $rows['id']; ?>'><?php echo $status; ?></a>
                                                        </td>
                                                        <td>
                                                            <a href="add-cat.php?edit=<?php echo $rows['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit" class="fa fa-edit text-success mr-3"></a>
                                                            <a href="view-cat.php?delete=<?php echo $rows['id']; ?>&cat_url=<?php echo $rows['cat_url']; ?>" data-toggle="tooltip" data-placement="bottom" title="Delete" class="del ti-trash text-danger"></a>
                                                        </td>
                                                        <td><?php echo $rows['textarea']; ?></td>
                                                    </tr>
                                            <?php   }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
            $(".del").on("click", function(e) {
                if (!confirm("Are You Sure want to Delete ?")) {
                    e.preventDefault();
                    return false;
                } else {
                    return true;
                }
            });
            $(document).on('click', '.status', function(e) {
                e.preventDefault();
                var inner = $(this);
                var id = $(this).attr('data-id');
                var operation = $(this).attr('data-op');
                $.ajax({
                    url: 'ajax.php',
                    type: 'POST',
                    data: {
                        operation: 'status',
                        status: operation,
                        table: 'category',
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