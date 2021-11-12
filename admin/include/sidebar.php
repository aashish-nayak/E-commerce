
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="dashboard.php" style="color:white;font-size:20px;"><img src="../assets/images/menu/logo/LOGO.png" alt=""></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li><a href="dashboard.php"><i class="ti-dashboard"></i><span>dashboard</span></a></li>
                    <?php 
                        if($user['role']!= 'manage_enquiry'){
                    ?>
                        <li><a href="view-cat.php"><i class="ti-layout-grid2-alt"></i> <span>View Category</span></a></li>
                        <li><a href="add-cat.php"><i class="ti-plus"></i> <span>Add Category</span></a></li>
                        <li><a href="javascript:void(0)"><i class="ti-layers-alt"></i> <span>View Products</span></a>
                        <ul>
                        <?php $navresult = mysqli_query($conn,"SELECT * FROM $catTB WHERE parent_id=0");
                            while($nav = mysqli_fetch_assoc($navresult)){ ?>
                                <li><a href="view-pages.php?view=<?php echo $nav['cat_url'];?>" class="d-flex justify-content-between"><span><?php echo limitstring($nav['cat_name'],4);?></span><span class="badge badge-light" style="line-height: inherit;"><?php echo $count = count(allProducts($conn,$nav['cat_url']));?></span></a></li>
                            <?php }
                        ?>
                        </ul>
                    </li>
                    <li><a href="add-page.php"><i class="ti-plus"></i> <span>Add Product</span></a></li>
                    <?php }?>
                    <?php 
                        if($user['role']== 'superadmin'){
                    ?>
                    <li><a href="users.php" class="d-flex"><div class="col-8 p-0"><i class="ti-user"></i> <span>Users</span></div><div class="col-4 p-0 text-right"><span class="badge badge-light" style="line-height: inherit;"></span></div></a></li>
                    <?php }?>
                    <?php 
                        if($user['role']!= 'manage_product'){
                    ?>
                    <li><a href="enquiry.php" class="d-flex"><div class="col-8 p-0"><i class="ti-email"></i> <span>Enquiry</span></div><div class="col-4 p-0 text-right"><span class="badge badge-light" style="line-height: inherit;"></span></div></a></li>
                    <?php }?>
                    <?php 
                        if($user['role']== 'superadmin' || $user['role']== 'admin'){
                    ?>
                    <li><a href="distributer.php" class="d-flex"><div class="col-8 p-0"><i class="ti-world"></i> <span>Distributers</span></div><div class="col-4 p-0 text-right"><span class="badge badge-light" style="line-height: inherit;"></span></div></a></li>
                    <?php }?>
                    <li><a href="change-password.php"><i class="ti-reload"></i> <span>Change Password</span></a></li>
                    <li><a href="logout.php"><i class="ti-power-off"></i> <span>Log Out</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
