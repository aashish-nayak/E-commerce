<?php 
    if(isset($_GET['logout'])){
        unset($_SESSION['login_id']);
        header("url=index.php");
    }
?>
<header class="bg-midnight">
<div class="header-top bg-polo-blue">
                <div class="container">
                    <div class="header-top-nav">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                            
                            </div>
                            <div class="col-lg-7 col-md-6 text">
                                <div class="header-top-right">
                                    <ul class="user-block list-inline">
                                        <li><a href="login-register.html">My Account</a></li>
                                        <li><a href="checkout.php">Checkout</a></li>
                                        <li><a href="" style="text-transform:none;"><?php 
                                        if(isset($_SESSION['login_id'])){
                                            $login = mysqli_query($conn,"SELECT * FROM customers WHERE customer_id='{$_SESSION['login_id']}'");
                                            $custrow = mysqli_fetch_assoc($login);
                                            echo $custrow['name'];
                                        }else{
                                            echo "Sign In";
                                        }?></a></li>
                                        <?php if(isset($_SESSION['login_id'])){?>
                                        <li><a href="?logout=yes">Logout</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!-- Begin Header Middle Area -->
    <div class="header-middle bg-gray">
        <div class="container logo-nav">
            <div class="row align-items-center">
                <!-- Begin Logo Area -->
                <div class="col-lg-3">
                    <div class="logo">
                        <a href="index.php">
                            <img src="assets/images/menu/logo/LOGO (1).png" class="logo-img" alt="FB's Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header-middle-right">
                        <!-- ================= Ajax Live Search Engine ===================== -->
                        <form action="search.php" method="GET" role="search" class="hm-searchbox">
                            <input type="text" name="search" placeholder="Enter your search key ..." autocomplete="off" id="search-box">
                            <ul class="auto-com" id="ajax">

                            </ul>
                            <button class="fb-search_btn" name="submit" type="submit"><i class="fa fa-search"></i>
                            </button>
                        </form>
                        <!-- ================= Ajax Live Search Engine ===================== -->
                    </div>
                </div>
                <?php $siteinfo = siteDetails(); ?>
                <div class="col-lg-3 text-right">
                    <div class="hb-contact-info">
                        <ul>
                            <li class="phone mt-xs-20 text-dark" style="font-weight: 500;"><span><i class="fa fa-phone"></i> : </span><a href="tel:<?php echo $siteinfo['landline']; ?>"><?php echo $siteinfo['landline']; ?></a></li>
                            <li class="phone mt-xs-20 text-dark" style="font-weight: 500;"><span><i class="fa fa-envelope"></i> : </span><a href="mailto:<?php echo $siteinfo['e-mail-1']; ?>"><?php echo $siteinfo['e-mail-1']; ?></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Header Middle Right Area End Here -->
                <!-- Logo Area End Here -->
                <!-- Begin Header Middle Right Area -->
            </div>
        </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom bg-polo-blue header-sticky stick">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Begin Category Menu Area -->
                <div class="col-lg-3 col-md-5 col-sm-6">
                    <!--Category Menu Start-->
                    <div class="category-menu category-menu-hidden">
                        <div class="category-heading">
                            <h2 class="categories-toggle"><span>All Categories</span></h2>
                        </div>
                        <div id="cate-toggle" class="category-menu-list">
                            <ul>
                                <?php echo findsubcat($env, $conn, 0) ?>
                            </ul>
                        </div>
                    </div>
                    <!--Category Menu End-->
                </div>
                <!-- Category Menu Area End Here -->
                <!-- Begin Header Bottom Menu Area -->
                <div class="col-md-7 d-none d-lg-block d-xl-block position-static">
                    <!-- FB's Navigation -->
                    <nav class="fb-navigation">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about-us.php">About Us</a></li>
                            <li><a href="<?php echo $env . "distributers" ?>">Distributor Network</a></li>
                            <li><a href="contact-us.php">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-2 d-none d-lg-block d-xl-block position-static">
                    <!-- Header Middle Searchbox Area End Here -->
                    <ul class="hm-menu">
                        <!-- Begin Header Mini Cart Area -->
                        <li class="hm-minicart">
                            <div class="hm-minicart-trigger">
                                <span class="item-icon"></span>
                                <span class="item-text">My Cart
                                    <span class="cart-item-count" id="totalqty"></span>
                                </span>
                                <span class="item-total" id="total"></span>
                            </div>
                            <span></span>
                            <div class="minicart">
                                <ul class="minicart-product-list" id="cart">
                                    
                                </ul>
                                <div class="price-content" id="grandTotal">
                                    <!-- <p class="minicart-total">Shipping<span>$7.00</span></p>
                                    <p class="minicart-total">Taxes<span>$0.00</span></p> -->
                                </div>
                                <div class="minicart-button text-center">
                                    <a href="checkout.php" class="fb-btn">
                                        <span>Checkout</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!-- Header Mini Cart Area End Here -->
                    </ul>
                </div>
            </div>
            <div class="row">
                <!-- Begin Mobile Menu Area -->
                <div class="mobile-menu-area d-lg-none d-xl-none col-12">
                    <div class="mobile-menu"></div>
                </div>
                <!-- Mobile Menu Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Bottom Area End Here -->
</header>