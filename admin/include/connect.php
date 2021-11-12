<?php
define("LOCAL", "http://localhost/PHP/Add-to-cart_Practice/home-app-3/page.php?url=");
define("WEB", "https://www.khandelwalrealtor.com/");
$env = LOCAL; //change to WEB if you're live
if (0) { // make 1 for live and 0 for local
    $host = "localhost";
    $username = "u161482489_krpropu";
    $password = "u~@yXrPi/PZ9";
    $database = "u161482489_krprop"; //as in phpmyadmin
} else { //Local
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "home_app"; //as in phpmyadmin
}
// Create connection
$conn = mysqli_connect($host, $username, $password, $database) or die("Connection Failed");
if ($conn) {
    //echo "Connected With DataBase";
} else{
    "Not Connected with Database ";
}

// ============ DATABASE TABLES DECLAREATION ==============
$webUser = 'website_user';
$logtry = 'logintry';
$catTB = 'category';
$page = 'page';
$pageImg = 'images_tb';
$enquiry = 'enquiry';
$dist = 'distributers';