<?php 
include "admin/include/connect.php";
include "admin/include/functions.php";
session_start();
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <title>Home - Khaitan Orfin</title>
    <?php include_once "include/head-links.php"; ?>
</head>

<body>
    <div class="body-wrapper bg-white">
    <?php include_once "include/nav.php"; ?>
    <?php include_once "include/main-slider.php"; ?>
    <?php include_once "include/cat-slider.php"; ?>
    <?php include_once "include/customer-supp.php"; ?>
    <?php include "include/product-slider.php"; ?>
    <?php include "include/row-2-cat-pro.php"; ?>
    <?php include_once "include/footer.php"; ?>
    <?php include_once "include/model-popup.php"; ?>
<script>

    
    function addtocart(id) {
        console.log(id);
    }
    
</script>
</body>

</html>