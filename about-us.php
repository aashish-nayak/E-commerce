<?php 
include "admin/include/connect.php";
include "admin/include/functions.php";
session_start();
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <title>About Us - Khaitan Orfin</title>
    <?php include_once "include/head-links.php"; ?>
</head>
<body>
    <!-- Begin Body Wraper Area -->
    <div class="body-wrapper bg-white">

        <?php include_once "include/nav.php"; ?>
        <!-- Begin FB's Breadcrumb Area -->
        <div class="breadcrumb-area pt-30 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li class="active">About Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FB's Breadcrumb Area End Here -->
        <!-- Begin Page Content Area -->
        <main class="page-content">
            <!-- About Page Area -->
            <div class="about-area section-padding-lg pb-50 ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-thumb fb-img-hover-effect">
                                <a href="#">
                                    <img src="assets/images/1.jpg" alt="about image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-content">
                                <h2>WELCOME TO <span style="font-weight: 700;">Khaitan Orfin</span> WORLD</h2>
                                <p>We Provide Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae nisi
                                    fuga facilis, consequuntur, maiores eveniet voluptatum, omnis possimus temporibus
                                    aspernatur nobis animi in exercitationem vitae nulla! Adipisci ullam illum quisquam.
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, nulla veniam?
                                    Magni aliquid asperiores magnam. Veniam ex tenetur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--Page Content Area End Here -->
        <?php include_once "include/footer.php"; ?>
        <!-- Begin Fb's Quick View | Modal Area -->
        <?php include_once "include/model-popup.php"; ?>
</body>

</html>