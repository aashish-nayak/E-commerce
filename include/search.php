<?php

$sql= "SELECT * FROM page WHERE title LIKE '%$url%' OR url LIKE '%$url%' OR description LIKE '%$url%' OR cat_type LIKE '%$url%'";
$result = mysqli_query($conn, $sql);
$per_page = 6;
$count=  mysqli_num_rows($result);

$pagi = ceil($count / $per_page);

$start = $page-1;
$start = $start *  $per_page;

$prod = mysqli_query($conn, "SELECT * FROM page WHERE title LIKE '%$url%' OR url LIKE '%$url%' OR description LIKE '%$url%' OR cat_type LIKE '%$url%' ORDER BY id DESC LIMIT $start, $per_page");
$search_results = mysqli_num_rows($prod);
?>
<div class="breadcrumb-area pt-30 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a><?php echo $start."- ".$per_page." of over ".$count;?> results for "<?php echo ucwords($_GET['search']);?>"</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-wraper mb-35">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-1 order-lg-1">
                <div class="shoptopbar-heading">
                    <h1><?php //echo str_replace("-", " ", end($arr)); ?></h1>
                </div>
                <div class="shop-products-wrapper bg-white mt-30 mb-60 pb-sm-30">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="fb-product_wrap shop-product-area">
                                <div class="row">
                                    <?php
                                    if (mysqli_num_rows($prod) > 0) {
                                        while ($pro = mysqli_fetch_assoc($prod)) {
                                            $proimg = mysqli_query($conn, "SELECT * FROM images_tb WHERE img_id='{$pro['id']}'");
                                            $proImgs = mysqli_fetch_assoc($proimg); ?>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="single-product">
                                                    <div class="product-img">
                                                        <a href="<?php echo $env . $pro['url']; ?>">
                                                            <img class="primary-img" src="admin/uploads/<?php echo $proImgs['img1']; ?>" alt="FB'S Prduct">
                                                            <img class="secondary-img" src="admin/uploads/<?php echo $proImgs['img2']; ?>" alt="FB'S Prduct">
                                                        </a>
                                                        <div class="sticker-2"><span>Product</span></div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h2 class="product-name">
                                                            <a href="<?php echo $env . $pro['url']; ?>"><?php echo $pro['title']; ?></a>
                                                        </h2>
                                                        <p class="product-list"><a style="border-bottom: 1px solid #a7a3a3;" href="<?php echo $env . $pro['url']; ?>">View
                                                                More</a></p>
                                                        <div class="product-action">
                                                            <ul class="product-action-link">
                                                                <li class="quick-view-btn"><a href="#" title="Quick View" data-toggle="modal" data-target="#exampleModalCenter"><i class="ion-eye"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="paginatoin-area">
                            <div class="row justify-content-center">
                                <div class="col-lg-6 col-md-6">
                                    <ul class="pagination-box pt-xs-20 pb-xs-15" id="pagination">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-2 order-lg-2">
                <?php include "include/side-form.php"; ?>
            </div>
        </div>
    </div>
</div>