<div class="fb-banner_with_list-product our-products pb-60">
    <div class="container">
        <div class="fb-product_list_nav">
            <div class="row no-gutters">
                <div class="col-xl-3 col-lg-4">
                    <div class="fb-section_title-2">
                        <h2>Latest Products</h2>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="fb-single-product-slide_wrap bg-white">
                        <div class="fb-product_active-4 text-center owl-carousel">
                            <!-- Begin Sigle Product Area -->
                            <?php
                            $latest_pro = mysqli_query($conn, "SELECT * FROM page ORDER BY id DESC LIMIT 10");
                            while ($product = mysqli_fetch_assoc($latest_pro)) {
                                $imgs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM images_tb WHERE img_id='{$product['id']}'"));
                                ?>
                                <div class="single-product">
                                    <!-- Begin Product Image Area -->
                                    <div class="product-img">
                                        <a href="<?php echo $env.$product['url'];?>">
                                            <?php if($imgs['img1']!=""){ echo '<img class="primary-img" src="admin/uploads/'.$imgs['img1'].'" alt="FBS Prduct">';}?>
                                            <?php if($imgs['img2']!=""){ echo '<img class="secondary-img" src="admin/uploads/'.$imgs['img2'].'" alt="FBS Prduct">';}?>
                                        </a>
                                    </div>
                                    <!-- Product Image Area End Here -->
                                    <!-- Begin Product Content Area -->
                                    <div class="product-content">
                                        <h2 class="product-name">
                                            <a href="<?php echo $env.$product['url'];?>" title="<?php echo $product['title'];?>"><?php echo limitstring($product['title'],8);?></a>
                                        </h2>
                                    </div>
                                    <div class="price-box">
                                            <span class="new-price">₹ <?php echo $product['price'];?></span>
                                            <!-- <span class="old-price">$50.99</span> -->
                                    </div>
                                    <div class="product-action">
                                        <ul class="product-action-link">
                                            <li class="quick-view-btn"><a href="#" title="Quick View" data-id="<?php echo $product['id'];?>" data-toggle="modal" data-target="#exampleModalCenter"><i class="ion-eye"></i></a></li>
                                        </ul>
                                    </div>
                                    <p class="text-center product-list"><a style="border-bottom: 1px solid #a7a3a3;" href="<?php echo $env.$product['url'];?>">View More</a></p>
                                    <!-- Product Content Area End Here -->
                                </div>
                            <?php }
                            ?>
                            <!-- Sigle Product Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>