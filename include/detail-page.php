<!-- Begin FB's Breadcrumb Area -->
<div class="breadcrumb-area pt-30 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <?php $string = findlevel($conn, $_GET['url'], true);
                        $arr = array_reverse(array_filter(explode(",", $string)));
                        foreach ($arr as $key => $val) {
                            echo '<li><a href="' . $env . $val . '">' . ucwords(str_replace("-", " ", $val)) . '</a></li>';
                        }
                        ?>
                        <li class="active"><?php echo ucwords(str_replace("-", " ", $url)); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FB's Breadcrumb Area End Here -->
<!-- Begin FB's Page Content Area -->
<div class="page-content">
    <!-- Product Details Area -->
    <div class="product-details-area">
        <div class="container">
            <div class="pdetails bg-white">
                <div class="row">
                    <div class="col-lg-5">
                        <?php
                        $detailQ = "SELECT * FROM page WHERE url='$url' AND status=1";
                        $detail = mysqli_query($conn, $detailQ);
                        $Ditelrow = mysqli_fetch_assoc($detail);
                        $proimg = mysqli_query($conn, "SELECT * FROM images_tb WHERE img_id='{$Ditelrow['id']}'");
                        $proImgs = mysqli_fetch_assoc($proimg); ?>
                        <div class="pdetails-images">
                            <div class="pdetails-largeimages pdetails-imagezoom">
                                <?php for ($i = 1; $i <= 5; $i++) {
                                    if ($proImgs['img' . $i . ''] != "") { ?>
                                        <div class="pdetails-singleimage" data-src="admin/uploads/<?php echo $proImgs['img' . $i . '']; ?>">
                                            <img src="admin/uploads/<?php echo $proImgs['img' . $i . '']; ?>" alt="product image">
                                        </div>
                                <?php }
                                } ?>
                            </div>

                            <div class="pdetails-thumbs">
                                <?php for ($i = 1; $i <= 5; $i++) {
                                    if ($proImgs['img' . $i . ''] != "") { ?>
                                        <div class="pdetails-singlethumb" data-src="admin/uploads/<?php echo $proImgs['img' . $i . '']; ?>">
                                            <img src="admin/uploads/<?php echo $proImgs['img' . $i . '']; ?>" alt="product thumb">
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="product-details-view-content mt-20">
                            <div class="product-info">
                                <h1><?php echo $Ditelrow['title']; ?></h1>
                                <div class="price-box pb-10">
                                    <span class="new-price">₹ <?php echo $Ditelrow['price']; ?> </span>
                                </div>
                                <div class="product-desc">
                                    <p>
                                        <span><?php echo $Ditelrow['description']; ?> </span>
                                    </p>
                                </div>
                                <div class="single-add-to-cart">
                                    <form action="#" class="cart-quantity mt-0">
                                        <div class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i>
                                                </div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </div>
                                        <a href="" class="fb-btn add-to-cart">Add to cart</a>
                                    </form>
                                </div>
                                <div class="footer-widget-social-link footer-widget-social-link-2">
                                    <span>Share</span>
                                    <ul class="social-link">
                                        <li class="facebook">
                                            <a href="https://www.facebook.com/" data-toggle="tooltip" target="_blank" title="Facebook">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="https://twitter.com/" data-toggle="tooltip" target="_blank" title="Twitter">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="youtube">
                                            <a href="https://www.youtube.com/" data-toggle="tooltip" target="_blank" title="Youtube">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        </li>
                                        <li class="google-plus">
                                            <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google Plus">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a href="https://www.instagram.com/" data-toggle="tooltip" target="_blank" title="Instagram">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Details Area End Here -->
    <!-- Begin FB's Product With Banner Area -->
    <div class="fb-product_with_banner fb-featured-pro_with_banner other-product pt-60 pb-60">
        <div class="container">
            <div class="other-product-nav bg-white">
                <div class="fb-section_title-2">
                    <h2><?php echo ucfirst($arr[0]); ?></h2>
                </div>
                <div class="row no-gutters">
                    <!-- Begin FB's Product Wrap Area -->
                    <div class="col-lg-12">
                        <div class="fb-product_wrap bg-white mt-sm-60 mt-xs-60">
                            <div class="fb-other-product_active owl-carousel">
                                <?php $proArr = allProducts($conn, $arr[0]);
                                $i = 1;
                                foreach ($proArr as $key => $value) {
                                    if ($i <= 12) {
                                ?>
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="<?php echo $env . $value['url']; ?>">
                                                    <img class="primary-img" src="admin/uploads/<?php echo $value['img1'] ?>" alt="FB'S Prduct">
                                                    <img class="secondary-img" src="admin/uploads/<?php echo $value['img2'] ?>" alt="FB'S Prduct">
                                                </a>
                                                <div class="sticker-2"><span>Products</span></div>
                                            </div>
                                            <div class="product-content">
                                                <h2 class="product-name custom-font">
                                                    <a href="<?php echo $env . $value['url']; ?>" title="<?php echo $value['title']; ?>"><?php echo limitstring($value['title'], 8); ?></a>
                                                </h2>
                                            </div>
                                            <div class="price-box">
                                                <span class="new-price">₹ <?php echo $value['price'];?></span>
                                            <!-- <span class="old-price">$50.99</span> -->
                                            </div>
                                            <div class="product-action">
                                                <ul class="product-action-link">
                                                    <li class="quick-view-btn"><a href="#" data-id="<?php echo $value['id'];?>" title="Quick View" data-toggle="modal" data-target="#exampleModalCenter"><i class="ion-eye"></i></a></li>
                                                </ul>
                                            </div>
                                            <!-- Product Content Area End Here -->
                                        </div>
                                <?php }
                                    $i++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- FB's Product Wrap Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- FB's Product Area End Here -->
</div>