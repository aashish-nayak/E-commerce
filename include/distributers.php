<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area pt-30 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li class="active"><?php echo ucwords(str_replace("-"," ",$url))?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<div class="fb-main-blog-page pt-10 pb-40 pb-sm-15 pb-xs-15">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Blog Sidebar Area -->
            <div class="col-lg-3 order-lg-2 order-2">
                <?php include "include/side-form.php"; ?>
            </div>
            <!-- Li's Blog Sidebar Area End Here -->
            <!-- Begin Li's Main Content Area -->
            <div class="col-lg-9 order-lg-1 order-1">
                <div class="shoptopbar-heading mb-30">
                    <h1>Distributer Network</h1>
                </div>
                <div class="row bg-white fb-main-content ">
                    <?php
                    include "include/pagination.php";
                    $dist = mysqli_query($conn, "SELECT * FROM distributers ORDER BY id DESC LIMIT $start, $per_page");
                    if (mysqli_num_rows($dist) > 0) {
                        while ($row = mysqli_fetch_assoc($dist)) { ?>
                            <div class="col-lg-6 col-md-6 border">
                                <div class="fb-blog-single-item pb-20 pb-xs-60 pl-30">
                                    <div class="fb-blog-content">
                                        <div class="fb-blog-details">
                                            <h2 class="fb-blog-heading pt-25"><a><?php echo $row['shop_name'] ?></a></h2>
                                            <div class="fb-blog-meta">
                                                <a class="author" href="#"><i class="fa fa-user"></i><?php echo $row['distri_name'] ?></a>
                                                <a class="comment" href="#"><i class="fa fa-map"></i><?php echo $row['city'] ?></a>
                                            </div>
                                            <div class="container px-0" style="min-height:100px;">
                                            <p class="m-0" style="font-size: 16px;display:flex;"><strong><i class="fa fa-map-pin mr-10"></i></strong><span style="line-height: 1.4;"><?php echo $row['address'] ?></span></p>
                                            <p style="font-size: 16px;"><strong><i class="fa fa-envelope mr-10"></i> </strong><a href="mailto:<?php echo $row['email'] ?>"><?php echo $row['email'] ?></a></p>
                                            </div>
                                            <div class="d-flex">
                                                <a href="tel:<?php echo $row['phone'] ?>" class="fb-btn border rounded add-to-cart pl-20 pr-20 custom-btn"><i class="fa fa-phone pr-5"></i> Contact Now</a>
                                                <a href="https://api.whatsapp.com/send?phone=<?php echo $row['whatsapp'] ?>" class="fb-btn text-dark bg-white add-to-cart pl-20 pr-20 custom-btn" style="display:flex;align-items:center"><i class="fa fa-whatsapp pr-5" style="font-size: 35px;color:#07bc4c;"></i> <span>Whatsapp Now</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    }
                    ?>
                </div>
            </div>
            <!-- Li's Main Content Area End Here -->
        </div>
    </div>
</div>