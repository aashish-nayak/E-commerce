<div class="breadcrumb-area pt-30 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <?php $string = findlevel($conn, $_GET['url']);
                        $arr = array_reverse(array_filter(explode(",", $string)));
                        foreach ($arr as $key => $val) {
                            echo '<li><a href="' . $env . $val . '">' . ucwords(str_replace("-", " ", $val)) . '</a></li>';
                        }
                        ?>
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
                    <h1><?php echo str_replace("-", " ", end($arr)); ?></h1>
                </div>
                <div class="shop-products-wrapper bg-white mt-30 mb-60 pb-sm-30">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="fb-product_wrap shop-product-area">
                                <div class="row">
                                    <?php
                                    include "include/pagination.php";
                                    $catUrl = mysqli_query($conn, "SELECT id FROM category WHERE cat_url='$url'");
                                    $idArr = mysqli_fetch_assoc($catUrl);
                                    $catId = $idArr['id'];
                                    $query = mysqli_query($conn, "SELECT * FROM category WHERE parent_id='$catId' AND status=1 ORDER BY id DESC LIMIT $start, $per_page");
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($catRow = mysqli_fetch_assoc($query)) { ?>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="single-product">
                                                    <div class="product-img">
                                                        <a href="<?php echo $env . $catRow['cat_url']; ?>">
                                                            <img class="primary-img" src="admin/uploads/<?php echo $catRow['main_img']; ?>" alt="FB'S Prduct">
                                                        </a>
                                                        <div class="sticker" style="right: 0;left:auto;"><span>Category</span></div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h2 class="product-name">
                                                            <a href="<?php echo $env . $catRow['cat_url']; ?>"><?php echo $catRow['cat_name']; ?></a>
                                                        </h2>
                                                        <p class="product-list"><a style="border-bottom: 1px solid #a7a3a3;" href="<?php echo $env . $catRow['cat_url']; ?>">View
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
                                        $prod = mysqli_query($conn, "SELECT * FROM page WHERE cat_type='$url' AND status=1 ORDER BY id DESC LIMIT $start, $per_page");
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
                                                        </div>
                                                        <div class="price-box">
                                                            <span class="new-price">₹ <?php echo $pro['price']; ?></span>
                                                            <!-- <span class="old-price">$50.99</span> -->
                                                        </div>
                                                        <p class="product-list"><a style="border-bottom: 1px solid #a7a3a3;" href="<?php echo $env . $pro['url']; ?>">View
                                                                More</a></p>
                                                        <div class="product-action">
                                                            <ul class="product-action-link">
                                                                <li class="quick-view-btn"><a href="#" title="Quick View" data-id="<?php echo $pro['id']; ?>" data-toggle="modal" data-target="#exampleModalCenter"><i class="ion-eye"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }
                                    } else {
                                        $prod = mysqli_query($conn, "SELECT * FROM page WHERE cat_type='$url' AND status=1 ORDER BY id DESC LIMIT $start, $per_page");
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
                                                        </div>
                                                        <div class="price-box">
                                                            <span class="new-price">₹ <?php echo $pro['price']; ?></span>
                                                            <!-- <span class="old-price">$50.99</span> -->
                                                        </div>
                                                        <p class="product-list"><a style="border-bottom: 1px solid #a7a3a3;" href="<?php echo $env . $pro['url']; ?>">View
                                                                More</a></p>
                                                        <div class="product-action">
                                                            <ul class="product-action-link">
                                                                <li class="quick-view-btn"><a href="#" title="Quick View" data-id="<?php echo $pro['id']; ?>" data-toggle="modal" data-target="#exampleModalCenter"><i class="ion-eye"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php }
                                        }
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