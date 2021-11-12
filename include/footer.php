<div class="fb-footer">
    <!-- Begin Footer Top Area -->
    <div class="fb-footer_top">
        <div class="container">
            <div class="row">
                <!-- Begin FB's Newsletters Area -->
                <div class="col-lg-8">
                    <div class="fb-newsletters">
                        <h2 class="newsletters-headeing">Send Us Your Feedback</h2>
                        <p class="short-desc">Send us Feedback aboout your Satisfaction and your Exerperiance.</p>
                    </div>
                </div>
                <!-- FB's Newsletters Area End Here -->
                <!-- Begin FB's Newsletters Form Area -->
                <div class="col-lg-4">
                    <div class="fb-newsletters_form pt-sm-15 pt-xs-15">
                            <div id="mc_embed_signup_scroll">
                                <div id="mc-form" class="mc-form subscribe-form form-group">
                                    <!-- <input id="mc-email" type="email" autocomplete="off" placeholder="Write your Feedback" /> -->
                                    <a class="btn mt-sm-15 mt-xs-15 pl-50 pr-50" href="<?php echo $env."distributers";?>">Enquiry Now</a>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- FB's Newsletters Form Area End Here -->
            </div>
        </div>
    </div>
    <!-- Footer Top Area End Here -->
    <!-- Begin FB's Footer Middle Area -->
    <div class="fb-footer_middle bg-white">
        <div class="container">
            <!-- Begin Footer Middle Top Area -->
            <div class="footer-middle_top">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-sm-7">
                        <div class="footer-widget-logo pt-30 mb-20 pt-sm-5 pt-xs-5">
                            <a href="index.php">
                                <img src="assets/images/menu/logo/LOGO (1).png" class="logo-img" alt="FB's Logo">
                            </a>
                        </div>
                        <div class="footer-widget-info">
                            <p class="footer-widget_short-desc">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis dicta illo nesciunt tenetur distinctio saepe nostrum repellendus at aliquid cum.
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-5">
                        <div class="fb-footer_widget pt-20">
                            <h3 class="fb-footer-widget-headeing">Top Products</h3>
                            <ul>
                                <?php
                                $footer_pro = mysqli_query($conn, "SELECT * FROM page WHERE status=1 ORDER BY RAND() LIMIT 5");
                                while ($prorow = mysqli_fetch_assoc($footer_pro)) { ?>
                                    <li><a href="<?php echo $env . $prorow['url']; ?>"><?php echo limitstring($prorow['title'],4); ?></a></li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-5 col-sm-7">
                        <div class="fb-footer_widget pt-20 pt-xs-0">
                            <h3 class="fb-footer-widget-headeing">Categories</h3>
                            <ul>
                                <?php
                                $footer_cat = mysqli_query($conn, "SELECT * FROM category WHERE parent_id='0'");
                                while ($catrow = mysqli_fetch_assoc($footer_cat)) { ?>
                                    <li><a href="<?php echo $env . $catrow['cat_url']; ?>"><?php echo $catrow['cat_name']; ?></a></li>
                                <?php }
                                ?>

                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="fb-footer_widget pt-20 pt-xs-0">
                            <h3 class="fb-footer-widget-headeing">Contact info</h3>
                            <div class="footer-widget_address">
                                <p class="m-0"><strong>Address:</strong> <?php echo $siteinfo['address'];?></p>
                                <p class="m-0"><strong>Email: </strong><a href="mailto:<?php echo $siteinfo['e-mail-1'];?>"><?php echo $siteinfo['e-mail-1'];?></a></p>
                                <p class="m-0"><strong>Email: </strong><a href="mailto:<?php echo $siteinfo['e-mail-2'];?>"><?php echo $siteinfo['e-mail-2'];?></a></p>
                                <p class="m-0"><strong>Phone: </strong><a href="tel:<?php echo $siteinfo['landline'];?>"><?php echo $siteinfo['landline'];?></a></p>
                            </div>
                            <div class="footer-widget-social-link">
                                <ul class="social-link">
                                    <li class="facebook">
                                        <a href="#" data-toggle="tooltip" target="_blank" title="Facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="#" data-toggle="tooltip" target="_blank" title="Twitter">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="youtube">
                                        <a href="#" data-toggle="tooltip" target="_blank" title="Youtube">
                                            <i class="fa fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li class="google-plus">
                                        <a href="#" data-toggle="tooltip" target="_blank" title="Google Plus">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li class="instagram">
                                        <a href="#" data-toggle="tooltip" target="_blank" title="Instagram">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="footer-middle-bottom">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-tag-links pt-20 pb-20">
                            <ul>
                                <li><a href="#">Online Shopping</a></li>
                                <li><a href="#">Promotions</a></li>
                                <li><a href="#">My Orders</a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Most Populars</a></li>
                                <li><a href="#">New Arrivals</a></li>
                                <li><a href="#">Special Products</a></li>
                                <li><a href="#">Manufacturers</a></li>
                                <li><a href="#">Our Stores</a></li>
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Payments</a></li>
                                <li><a href="#">Warantee</a></li>
                                <li><a href="#">Refunds</a></li>
                                <li><a href="#">Checkout</a></li>
                                <li><a href="#">Discount</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Policy</a></li>
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Payments</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Refunds</a></li>
                            </ul>
                        </div>
                        <div class="payment text-center pb-30">
                            <a href="#">
                                <img src="assets/images/payment/1.png" alt="FB's Footer Payment">
                            </a>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <!-- Begin Footer Bottom Area -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <!-- Begin Copyright Area -->
                <div class="col-lg-6 col-md-6">
                    <div class="copyright">
                        <span>Copyright &copy; 2021 || All rights reserved || <a href="sitemap.php">Sitemap</a> || Developed by <a href="https://www.maxfizz.com" target="_blank"> Maxfizz</a></span>
                    </div>
                </div>
                <!-- Copyright Area End Here -->
                <!-- Begin Footer Bottom Menu Area -->
                <div class="col-lg-6 col-md-6">
                    <div class="fotter-bottom_menu text-right">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about-us.php">About Us</a></li>
                            <li><a href="<?php echo $env."distributers";?>">Distributers</a></li>
                            <li><a href="contact-us.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Footer Bottom Menu Area End Here -->
            </div>
        </div>
    </div>
    <!-- Footer Bottom Area End Here -->
</div>