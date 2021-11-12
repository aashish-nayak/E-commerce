<?php
include "admin/include/connect.php";
include "admin/include/functions.php";
session_start();

$url = $_GET['search'];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <title><?php echo ucwords(str_replace("-"," ",$url));?> - Khaitan Orfin</title>
    <?php include_once "include/head-links.php"; ?>
</head>

<body>
    <!-- Begin Body Wraper Area -->
    <div class="body-wrapper  ">

        <?php include_once "include/nav.php"; ?>
        <?php
        include "include/search.php";
        ?>
        <?php include_once "include/footer.php"; ?>
        <!-- Begin Fb's Quick View | Modal Area -->
        <?php include_once "include/model-popup.php"; ?>
        <script type="text/javascript" src="assets/js/jq-paginator.js"></script>
        <script type="text/javascript">
            $.jqPaginator('#pagination', {
                totalPages: <?php echo $pagi; ?>,
                visiblePages: 4,
                currentPage: <?php echo $page; ?>,
                prev: '<li><a class="Previous" <?php if ($page == 1) echo 'style="pointer-events: none;"'; ?>href="<?php echo "search.php?search=" . $url . "&page={{page}}"; ?>"><i class="ion-chevron-left"></i> Previous</a></li>',
                next: '<li><a class="Next" <?php if ($page == $pagi) echo 'style="pointer-events: none;"'; ?>href="<?php echo "search.php?search=" . $url . "&page={{page}}"; ?>">Next <i class="ion-chevron-right"></i></a></li>',
                page: '<li><a href="<?php echo "search.php?search=". $url . "&page={{page}}"; ?>">{{page}}</a></li>',
                onPageChange: function(num, type) {
                    $('#p2').text(type + '：' + num);
                }
            });
        </script>
</body>

</html>