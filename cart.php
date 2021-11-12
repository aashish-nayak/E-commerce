<?php 
include "admin/include/connect.php";
include "admin/include/functions.php";
session_start();
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <title>Cart - Khaitan Orfin</title>
    <?php include_once "include/head-links.php"; ?>
</head>

<body>
    <div class="body-wrapper">
    <?php include_once "include/nav.php"; ?>
        <!-- Begin FB's Breadcrumb Area -->
        <div class="breadcrumb-area pt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FB's Breadcrumb Area End Here -->
        <!--Shopping Cart Area Strat-->
        <div class="Shopping-cart-area pt-60 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="#">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="fb-product-remove">remove</th>
                                            <th class="fb-product-thumbnail">images</th>
                                            <th class="cart-product-name">Product</th>
                                            <th class="fb-product-price">Unit Price</th>
                                            <th class="fb-product-quantity">Quantity</th>
                                            <th class="fb-product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cartPage">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-all">
                                        <div class="coupon">
                                            <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                                placeholder="Coupon code" type="text">
                                            <input class="button" name="apply_coupon" value="Apply coupon"
                                                type="submit">
                                        </div>
                                        <!-- <div class="coupon2">
                                            <input class="button" name="update_cart" value="Update cart" type="submit">
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Cart totals</h2>
                                        <ul>
                                            <li>Subtotal <span id="cart-subtotal">$130.00</span></li>
                                            <li>Total <span id="cart-grandtotal">$130.00</span></li>
                                        </ul>
                                        <a href="checkout.php">Proceed to checkout</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Shopping Cart Area End-->
        <?php include_once "include/footer.php"; ?>
        <?php include_once "include/model-popup.php"; ?>
</body>

</html>