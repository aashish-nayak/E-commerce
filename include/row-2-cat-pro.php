<?php
$category = mysqli_query($conn, "SELECT * FROM category WHERE parent_id='0' AND home=1 AND status=1 LIMIT 3");
if (mysqli_num_rows($category) > 0) {
    while ($catPro = mysqli_fetch_assoc($category)) {
?>
    <div class="fb-banner_with_list-product cookware-product pb-60">
            <div class="container">
                <div class="fb-product_list_nav">
                    <div class="row no-gutters">
                        <div class="col-xl-3 col-lg-4 col-md-5">
                            <div class="fb-section_title-2">
                                <h2><?php echo $catPro['cat_name']; ?></h2>
                            </div>
                            <!-- Begin FB's Banner Area -->
                            <div class="fb-banner fb-img-hover-effect">
                                <a href="<?php echo $env . $catPro['cat_url']; ?>">
                                    <img src="admin/uploads/<?php echo $catPro['banner_img']; ?>" alt="FB'S Banner">
                                </a>
                            </div>
                            <!-- FB's Banner Area End Here -->
                        </div>
                        <div class="col-xl-9 col-lg-8 col-md-7">
                            <div class="btn-group">
                                <button class="subcategories-trigger"><i class="fa fa-bars"></i></button>
                                <ul class="subcategories-list">
                                    <?php $MobcatNav = mysqli_query($conn, "SELECT * FROM category WHERE parent_id='{$catPro['id']}' LIMIT 4");
                                    if (mysqli_num_rows($MobcatNav) > 0) {
                                        while ($Mobsubcat = mysqli_fetch_assoc($MobcatNav)) {
                                    ?>
                                            <li><a href="<?php echo $env . $Mobsubcat['cat_url']; ?>"><?php echo $Mobsubcat['cat_name']; ?></a></li>
                                    <?php }
                                    } else {
                                        continue;
                                    } ?>
                                </ul>
                                <!-- Begin FB's List Product Menu Area -->
                                <ul class="list-product_menu">
                                    <?php $Desknav = mysqli_query($conn, "SELECT * FROM category WHERE parent_id='{$catPro['id']}' LIMIT 4");
                                    if (mysqli_num_rows($Desknav) > 0) {
                                        while ($Desksubcat = mysqli_fetch_assoc($Desknav)) {
                                    ?>
                                            <li><a href="<?php echo $env . $Desksubcat['cat_url']; ?>"><?php echo $Desksubcat['cat_name']; ?></a></li>
                                    <?php }
                                    } else {
                                        continue;
                                    } ?>
                                </ul>
                                <!-- FB's List Product Menu Area End Here -->
                            </div>
                            <!-- Begin FB's List Product Area -->
                            <div class="fb-list_product">
                                <div class="fb-list_product_active owl-carousel">
                                    <?php 
                                    $proArr = allProducts($conn, $catPro['cat_url']);
                                    // echo '<h1>'.count($proArr).'</h1>';
                                    $n = 0;
                                    foreach ($proArr as $key => $val) {
                                        if(count($proArr)>=1){
                                            if ($n%2 == 0) {
                                                echo singleProduct($env,$val['img1'],$val['img2'],$val['id'],$val['title'],$val['price'],$val['url'],'<div class="row no-gutters">');
                                            }else{
                                                echo singleProduct($env,$val['img1'],$val['img2'],$val['id'],$val['title'],$val['price'],$val['url'],'','</div>');
                                            }
                                        }else{
                                            echo singleProduct($env,$val['img1'],$val['img2'],$val['id'],$val['title'],$val['price'],$val['url'],'<div class="row no-gutters">','</div>');
                                        }
                                    $n++;
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- FB's List Product Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "include/extra-banner.php"; ?>
<?php
    }
}
?>

<!-- FB's Banner With List Product Area End Here -->