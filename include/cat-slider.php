<div class="list-single-slide_product pt-30">
    <div class="container text-center">
        <h2 class="py-3">Product Category</h2>
        <div class="list-product-nav">
            <div class="row">
                <div class="col-lg-12">
                    <div class="list-single-slide-active owl-loaded owl-drag owl-carousel">
                        <!-- Begin Sigle Product Area -->
                        <?php
                        $cat_slider = mysqli_query($conn, "SELECT * FROM category WHERE parent_id='0' AND status=1");
                        while ($cats = mysqli_fetch_assoc($cat_slider)) { ?>

                        <div class="list-product">
                            <!-- Begin Product Image Area -->
                            <div class="product-img list-product_img">
                                <a href="<?php echo $env.$cats['cat_url'];?>">
                                    <img class="primary-img" src="admin/uploads/<?php echo $cats['main_img'];?>"
                                        alt="FB'S Prduct">
                                </a>
                            </div>
                            <!-- Product Image Area End Here -->
                            <!-- Begin Product Content Area -->
                            <div class="product-content">
                                <h2 class="product-name">
                                    <a
                                        href="<?php echo $env.$cats['cat_url'];?>"><?php echo $cats['cat_name'];?></a>
                                </h2>
                                <p class="product-List">
                                    <a href="<?php echo $env.$cats['cat_url'];?>">View All Product</a>
                                </p>
                            </div>
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