<?php 
include "admin/include/connect.php";
include "admin/include/functions.php";
session_start();
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <title>Contact Us - Khaitan Orfin</title>
    <?php include_once "include/head-links.php"; ?>
</head>
<body>
    <!-- Begin Body Wraper Area -->
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
                                <li class="active">Contact Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FB's Breadcrumb Area End Here -->
        <!-- Begin Contact Main Page Area -->
        <div class="contact-main-page mt-60">
            <div class="container pt-30">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                        <div class="contact-page-side-content pl-sm-0 pl-xs-0">
                            <h3 class="contact-page-title">Contact Us</h3>
                            <p class="contact-page-message mb-25">Claritas est etiam processus dynamicus, qui sequitur
                                mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc
                                putamus parum claram anteposuerit litterarum formas human.</p>
                            <div class="single-contact-block">
                                <h4><i class="fa fa-fax"></i> Address</h4>
                                <p><?php echo $siteinfo['address'];?></p>
                            </div>
                            <div class="single-contact-block">
                                <h4><i class="fa fa-phone"></i> Phone</h4>
                                <p>Landline: <a href="tel:<?php echo $siteinfo['landline'];?>"><?php echo $siteinfo['landline'];?></a></p>
                                <p>Mobile: <a href="tel:<?php echo $siteinfo['landline'];?>"><?php echo $siteinfo['landline'];?></a></p>
                            </div>
                            <div class="single-contact-block last-child">
                                <h4><i class="fa fa-envelope-o"></i> Email</h4>
                                <p><a href="mailto:<?php echo $siteinfo['e-mail-1'];?>"><?php echo $siteinfo['e-mail-1'];?></a></p>
                                <p><a href="mailto:<?php echo $siteinfo['e-mail-2'];?>"><?php echo $siteinfo['e-mail-2'];?></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                        <div class="contact-form-content">
                            <h3 class="contact-page-title">Drop Your Message</h3>
                            <div class="contact-form">
                                <form onsubmit="return validateForm(this);" name="myform" method="POST" action="thank-you.php" role="form">
                                    <div class="form-group">
                                        <label>Your Name </label>
                                        <input type="text" name="name" required><span class="required"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Your Email  </label>
                                        <input type="email" name="email" required><span class="required"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="tel" name="phone"> <span class="required"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Your City </label>
                                        <input type="text" name="city" required><span class="required"></span>
                                    </div>
                                    <div class="form-group mb-30">
                                        <label>Your Message</label>
                                        <textarea name="message"></textarea> <span class="required"></span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="li-btn-3" name="submit">send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Main Page Area End Here -->
        <?php include_once "include/footer.php"; ?>
        <!-- Begin Fb's Quick View | Modal Area -->
        <?php include_once "include/model-popup.php"; ?>
</body>

</html>