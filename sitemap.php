<?php
include('admin/include/connect.php');
include('admin/include/functions.php');
header("Content-type: text/xml");
echo'<?xml version=\'1.0\' encoding=\'UTF-8\'?>';
echo'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
			 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    //get all page url from the database and display them
    $sql = "SELECT url FROM page WHERE status = '1'";
    $result = mysqli_query($conn, $sql); //fire query to the mysql DB
    if (mysqli_num_rows($result) > 0) { //mysqli_num_rows() => Gets the number of rows in a result
    // output data of each row
    while($row = mysqli_fetch_assoc($result)){
    echo '<url>
        <loc>'.trimurl($env,$row['url']).'</loc>
    </url>';
    }} //get all page url from the database and display them

    //get all category 1 and thier list page
    $sql = "SELECT cat_url FROM category WHERE status='1'"; //display all categories except NULL
    $result = mysqli_query($conn, $sql); //fire query to the mysql DB
    if (mysqli_num_rows($result) > 0) { //mysqli_num_rows() => Gets the number of rows in a result
    // output data of each row
    while($row = mysqli_fetch_assoc($result)){
    echo '<url>
        <loc>'.trimurl($env,$row['cat_url']).'</loc>
    </url>';
    }} //get all category 1 and thier list page


    echo '<url>
        <loc>'.trimurl($env,'index.php').'</loc>
    </url>';
    echo '<url>
        <loc>'.trimurl($env,'about-us.php').'</loc>
    </url>';
    echo '<url>
        <loc>'.trimurl($env,'contact-us.php').'</loc>
    </url>';    
    echo '<url>
        <loc>'.trimurl($env,'thank-you.php').'</loc>
    </url>';
    echo '</urlset>';
?>