<?php
include 'include/connect.php';
include 'include/functions.php';
checkSession();
$user = currentuser($conn, $_SESSION['user_id']); // this Function Return a Assoc Array of Current User
if ($user['role'] == "manage_enquiry") {
    header("Location: dashboard.php");
    $_SESSION['error'] = "You Do Not have Permission to Access this Page";
}

if (isset($_GET['view']) && $_GET['view'] != "") {
    $view = $_GET['view'];
    $sqlshow = "SELECT * FROM $page WHERE cat_type='$view'";
} else {
    $sqlshow = "SELECT * FROM $page";
}
$result = mysqli_query($conn, $sqlshow);
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    delImg($conn, $pageImg, 'img1', 'img_id', $id);
    delImg($conn, $pageImg, 'img2', 'img_id', $id);
    delImg($conn, $pageImg, 'img3', 'img_id', $id);
    delImg($conn, $pageImg, 'img4', 'img_id', $id);
    delImg($conn, $pageImg, 'img5', 'img_id', $id);
    $delete = "DELETE FROM $page WHERE id='$id'";
    mysqli_query($conn, $delete);
    $deleteimg = "DELETE FROM $pageImg WHERE img_id='$id'";
    mysqli_query($conn, $deleteimg);
    header("Location: view-pages.php");
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>View Products - Khaintan Orfin</title>
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
                                    <h4 class="page-title pull-left"><?php if (isset($_GET['view'])) {
                                                                    echo ucwords(str_replace("-"," ",$_GET['view']));
                                                                } else {
                                                                    echo 'View Pages';
                                                                } ?></h4>
                                    <ul class="breadcrumbs pull-left mt-2">
                                        <?php if (isset($view)) {
                                            //echo '<li><a href="view-pages.php">Home</a></li>';
                                            $string = findlevel($conn, $view);
                                            $arr = array_reverse(array_filter(explode(",", $string)));
                                            foreach ($arr as $key => $val) {
                                                if ($val == $view) {
                                                    echo '<li><span>' . ucwords(str_replace("-", " ", $val)) . '</span></li>';
                                                } else {
                                                    echo '<li><a href="view-pages.php?view=' . $val . '">' . ucwords(str_replace("-", " ", $val)) . '</a></li>';
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <ul class="breadcrumbs pull-left col-12 mt-4">
                                    <?php echo adminsubcat($conn,$_GET['view']);?>
                                    </ul>
                                </div>
                                <div class="data-tables datatable-primary">
                                    <table id="dataTable3" class="display responsive nowrap" style="max-width: 100%;">
                                        <thead class="text-capitalize bg-info">
                                            <tr>
                                                <th>S.no.</th>
                                                <th>Page Title</th>
                                                <?php if (!isset($_GET['view'])) {
                                                    echo "<th>Category</th>";
                                                } ?>
                                                <th>Order</th>
                                                <th>Status</th>
                                                <th>Operation</th>
                                                <th>Description</th>
                                                <th>Images</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td onclick="wrapclass(this);"><?php echo $i++; ?></td>
                                                    <td><?php echo limitstring($row['title'], 12); ?></td>
                                                    <?php if (!isset($_GET['view'])) {
                                                        echo "<td>" . $row['cat_type'] . "</td>";
                                                    } ?>
                                                    <td><?php echo $row['page_order']; ?></td>
                                                    <td><?php
                                                        if ($row['status'] == 1) {
                                                            $status = 'Active';
                                                            $data_op = 'Deactive';
                                                            $text = 'text-success';
                                                        } else {
                                                            $status = 'Deactive';
                                                            $data_op = 'Active';
                                                            $text = 'text-danger';
                                                        }
                                                        ?>
                                                        <a href='' class='status <?php echo $text; ?>' data-op='<?php echo $data_op; ?>' data-id='<?php echo $row['id']; ?>'><?php echo $status; ?></a>
                                                    </td>
                                                    <td>
                                                        <a href="add-page.php?edit=<?php echo $row['id']; ?>&cat=<?php echo $row['cat_type']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit" class="fa fa-edit text-success mr-3"></a>
                                                        <a href="view-pages.php?delete=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Delete" class="del ti-trash text-danger"></a>
                                                    </td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <?php $imagesrow = "SELECT * FROM $pageImg WHERE img_id='{$row['id']}'";
                                                    $resultrow = mysqli_query($conn, $imagesrow);
                                                    if (mysqli_num_rows($resultrow) > 0) {
                                                        $rowimg = mysqli_fetch_assoc($resultrow);
                                                    ?>
                                                        <td>
                                                            <div class="container">
                                                                <div class="row">
                                                                    <?php for ($j = 1; $j <= 5; $j++) {
                                                                        $imageItem = $rowimg['img' . strval($j)];
                                                                        if (isset($imageItem)) { ?>
                                                                            <img src="uploads/<?php echo $imageItem; ?>" style="height:60px;width:auto;padding:5px;">
                                                                    <?php } else {
                                                                            echo 'No Images Found';
                                                                        }
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                </tr>
                                        <?php }
                                                } ?>
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
                        table: 'page',
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

        function wrapclass(data) {
            $('#dataTable3').toggleClass('nowrap');
        }
    </script>
</body>

</html>