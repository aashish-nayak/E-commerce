<?php
date_default_timezone_set("Asia/Kolkata");

// ==================== Debugging Function ======================
function prx($arr)
{
  echo "<pre>";
  print_r($arr);
  echo '</pre>';
  // die();
}

// ================== Function For Count Number of Rows ===============
function countPage($conn, $table, $where, $id, $field = "*")
{
  $result = mysqli_query($conn, "SELECT $field FROM $table WHERE $where='$id'");
  $count = mysqli_num_rows($result);
  return $count;
}

// =================== Function for Check Session id ==============
function checkSession()
{
  session_start();
  if ($_SESSION['id'] != 'HJKaf1_H&56(*&^^&') {
    header("Location: index.php");
  }
}

// ===================== Get Data of Current User Login =================
function currentuser($conn, $id)
{
  $sql = "SELECT * FROM website_user WHERE id='$id'";
  return mysqli_fetch_assoc(mysqli_query($conn, $sql));
}

// ====================== Function for Limited String ===================
function limitstring($string, $limit)
{
  $shown_string = "";
  $num_words = $limit;
  $words = array();
  $words = explode(" ", $string, $num_words);

  if (count($words) == $num_words) {
    $words[$num_words - 1] = " ... ";
  }

  $shown_string = implode(" ", $words);
  return $shown_string;
}

// ===================== Array to String Function ============
function arrToString($arr)
{
  $string = null;
  $i = 0;
  foreach ($arr as $key => $val) {
    if ($i == count($arr) - 1) {
      $string .= $key . "=" . "'" . $val . "'";
    } else {
      $string .= $key . "=" . "'" . $val . "'" . ', ';
    }
    $i++;
  }
  return $string;
}

// ============= IMAGE OPERATION FUNCTION ===================

// =========== Image Upload Funtion ==============
function imgupload($img, $multi = false, $dir = 'uploads/')
{
  if ($multi == false) {
    $path = $dir;
    $img_name = $_FILES[$img]['name'];
    if (!$img_name == "") {
      $tmp_name = $_FILES[$img]['tmp_name'];
      $newName = strtolower(pathinfo($img_name, PATHINFO_FILENAME)) . "_" . date("h-i") . "_" . date("d-m-Y") . '_' . rand(1, 100000) . "." . pathinfo($img_name, PATHINFO_EXTENSION);
      $fullpath = $path . $newName;
      move_uploaded_file($tmp_name, $fullpath);
      return $newName;
    } else {
      return false;
    }
  } else {
    $path = $dir;
    $arr = [];
    for ($i = 0; $i < count($_FILES[$img]['name']); $i++) {
      $img_name = $_FILES[$img]['name'][$i];
      $tmp_name = $_FILES[$img]['tmp_name'][$i];
      $newName = strtolower(pathinfo($img_name, PATHINFO_FILENAME)) . "_" . date("h-i") . "_" . date("d-m-Y") . '_' . rand(1, 100000) . "." . pathinfo($img_name, PATHINFO_EXTENSION);
      $fullpath = $path . $newName;
      move_uploaded_file($tmp_name, $fullpath);
      $arr[] .= $newName;
    }
    return $arr;
  }
}

// ================== Image Delete Function =========================
function delImg($conn, $table, $imgName, $field = "", $id = "", $dir = 'uploads/')
{
  $sql = "SELECT * FROM $table";
  if (!$field == "" && !$id == "") {
    $sql .= " WHERE " . $field . " ='" . $id . "'";
    $img_r1 = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    unlink($dir . $img_r1[$imgName]);
  } else {
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        unlink($dir . $row[$imgName]);
      }
    }
  }
}

// ================== Image Update Function =======================
function updateImg($conn, $img, $id)
{
  $path = imgupload($img);
  if (!$path == false) {
    delImg($conn, 'images_tb', $img, 'img_id', $id);
    mysqli_query($conn, "UPDATE images_tb SET img_id='$id',$img='$path' WHERE img_id='$id'");
  }
}

// =================== IMAGE OPERATION FUNCTION ====================

function findUrl($conn, $url)
{
  $count = countPage($conn, 'page', 'url', $url);
  $count1 = countPage($conn, 'category', 'cat_url', $url);
  if ($count > 0) {
    $type = 'detail';
  } else if ($count1 > 0) {
    $type = 'cat';
  } else{
    $type = 'distributers';
  }
  return $type;
}

//change url between local and live
function trimurl($env, $url)
{
  if ($env == LOCAL){
    return $url;
  }else {
    if ($url != "sitemap.php") {
      $url = str_replace('.php', '', $url);
      $url = str_replace('index', '', $url);
      return $env . $url;
    } else {
      return $env . "sitemap.xml";
    }
  }
}
//change url between local and live

function findsubcat($env, $connect, $parent_id)
{

  $menu = "";
  if ($parent_id == 0) {
    $sql = "SELECT * FROM category WHERE parent_id=0 AND status=1 ORDER BY cat_order ";
  } else {
    $sql = "SELECT * FROM category WHERE parent_id='$parent_id' AND status=1 ORDER BY cat_order ";
  }
  $i=1;
  $result = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    if ($row["parent_id"]) {
      $menu .= "<li class='right-menu'><a href='" . $env . $row['cat_url'] . "'>" . $row['cat_name'] . "</a>";
    } else {
        $menu .= "<li class='right-menu'><a href='" . $env . $row['cat_url'] . "'>" . $row['cat_name'] . "</a>";
    }

    $row_id = $row["id"];
    $sql_b = "SELECT * FROM category WHERE parent_id ='$row_id'";
    $count = mysqli_query($connect, $sql_b);
    if ($count->num_rows > 0) {
      $menu .= "<ul>" . findsubcat($env, $connect, $row["id"]) . "</ul>";
    } else {
      $menu .= findsubcat($env, $connect, $row["id"]);
    }

    $menu .= "</li>";
    $i+1;
  }

  return $menu;
}


function getproduct($conn, $type)
{
  $product = [];
  $pro = mysqli_query($conn, "SELECT * FROM page WHERE cat_type='$type' AND status=1");
  if (mysqli_num_rows($pro) > 0) {
    while ($row = mysqli_fetch_assoc($pro)) {
      $img = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM images_tb WHERE img_id='{$row['id']}'"));
      array_push($product, [
        'id' => $row['id'],'title' => $row['title'], 'url' => $row['url'],'price' => $row['price'],'img1' => $img['img1'],
        'img2' => $img['img2'], 'img3' => $img['img3'], 'img4' => $img['img4'], 'img5' => $img['img5']
      ]);
    }
  }
  return array_filter($product);
}

function allProducts($conn, $url,$level=0)
{
  // error_reporting(0);
  $allProducts = [];
  $query = mysqli_query($conn, "SELECT * FROM category WHERE cat_url='$url'");
  if (mysqli_num_rows($query) > 0) {
    $id = mysqli_fetch_assoc($query);
    $query2 = mysqli_query($conn, "SELECT * FROM category WHERE parent_id='{$id['id']}'");
    if (mysqli_num_rows($query2) > 0) {
      while ($row = mysqli_fetch_assoc($query2)) {
        $allProducts = array_filter(array_merge_recursive($allProducts, getproduct($conn, $row['cat_url'])));
        $row_id = $row["id"];
        $sql_b = "SELECT * FROM category WHERE parent_id ='$row_id'";
        $count = mysqli_query($conn, $sql_b);
        if (mysqli_num_rows($count) > 0) {
          $allProducts = array_filter(array_merge_recursive($allProducts,allProducts($conn, $row['cat_url'],$level+1)));
        }
      }
    }
  }
  if($level==0){
    $allProducts = array_filter(array_merge_recursive($allProducts, getproduct($conn,$url)));
  }
  return array_filter($allProducts);
}

function singleProduct($env,$img1, $img2,$id,$title,$price, $url, $row_Top = "", $row_Bottom="")
{
  $html = "";
  $have = "";
  if ($row_Top != "") {
    $html .= $row_Top;
  }
  if($img2!=""){
    $have = '<img class="secondary-img" src="admin/uploads/' . $img2 . '" alt="">';
  }
  $html .= '<div class="single-product list-single_product">
              <div class="product-img list-product_img">
                <a href="' . $url . '">
                  <img class="primary-img" src="admin/uploads/' . $img1 . '" alt="">
                  '.$have.'</a>
              </div>
              <div class="product-content list-product_content">
                <h2 class="product-name">
                  <a href="' .$env.$url . '" title="'.$title.'" >' .limitstring($title,12) . '</a>
                </h2>
              </div>
              <div class="price-box">
                <span class="new-price">₹ '.$price.'</span>
              </div>
              <div class="product-action list-product_action">
                                                <ul class="product-action-link">
                                                    <li class="shopping-cart_link"><a href="javascript:void(0);" title="Add to Cart" data-proID="'.$id.'" ><i class="ion-bag"></i></a></li>
                                                    <li class="quick-view-btn"><a href="#" title="Quick View" data-id="'.$id.'" data-toggle="modal" data-target="#exampleModalCenter"><i class="ion-eye"></i></a></li>
                                                    <li class="single-product_link"><a href="' .$env.$url . '" title="'.$title.'"><i class="ion-link"></i></a></li>
                                                </ul>
                                            </div>
            </div>';
  if ($row_Bottom != "") {
    $html .= $row_Bottom;
  }
  return $html;
}

function findlevel($conn,$url,$page=false){
  $cat_url = "";
  if($page==true){
    $pro_cat = mysqli_query($conn,"SELECT cat_type FROM page WHERE url='$url'");
    $cat_type = mysqli_fetch_assoc($pro_cat);
    $url = $cat_type['cat_type'];
  }
  $query = mysqli_query($conn, "SELECT * FROM category WHERE cat_url='$url'");
  if (mysqli_num_rows($query) > 0) {
    $id = mysqli_fetch_assoc($query);
    $cat_url.=$id['cat_url'].",";
    $query2 = mysqli_query($conn, "SELECT * FROM category WHERE id='{$id['parent_id']}'");
    if (mysqli_num_rows($query2) > 0) {
      $row = mysqli_fetch_assoc($query2);
      $row_id = $row["parent_id"];
      $sql_b = "SELECT * FROM category WHERE parent_id ='$row_id'";
      $count = mysqli_query($conn, $sql_b);
      if(mysqli_num_rows($count)>0){
        $cat_url.=findlevel($conn,$row["cat_url"]);
      }

  }
  }
  return $cat_url;
}

function siteDetails(){
  $arr = ['landline'=>'+91-171-2980251','phone'=>'+91-171-2980251','e-mail-1'=>'info@khaitanorfin.com','e-mail-2'=>'sales@khaitanorfin.com','address'=>'Plot No. 32A, New Moti Nagar, Near HP Petrol Station,
  Ghanaur Road, Ambala City, Haryana 134 003'];
  
  return $arr;
}

function adminsubcat($connect, $url){

  $menu = ""; 
  $query = mysqli_fetch_assoc(mysqli_query($connect, "SELECT id FROM category WHERE cat_url='$url'"));
  $id = $query['id'];
  $result = mysqli_query($connect,"SELECT * FROM category WHERE parent_id='$id'");
  while ($row = mysqli_fetch_assoc($result)) {
    $menu .= "<a class='btn btn-secondary py-1 px-2 mr-3' href='view-pages.php?view=" .$row['cat_url'] . "'>" . $row['cat_name'] . "<span class='badge badge-light ml-2' style='line-height: inherit'>".count(allProducts($connect,$row['cat_url']))."</span></a>";
  }

  return $menu;
}

function tree_4_adding($connect,$parent_id,$for,$level=0){
  $menu = "";
  $dash="-";
  if ($parent_id == 0) {
    $sql = "SELECT * FROM category WHERE parent_id=0 AND status=1 ORDER BY cat_order ";
  } else {
    $sql = "SELECT * FROM category WHERE parent_id='$parent_id' AND status=1 ORDER BY cat_order ";
  }
  for($i=1;$i<$level;$i++){
    $dash.=$dash;  
  }
  $result = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    if ($row["parent_id"]!=0) {
      $menu .= "<option value='".$row[$for]."'>".$dash." ".$row['cat_name']."</option>";
    } else {
      $menu .= "<option value='".$row[$for]."'>".$row['cat_name']."</option>";
    }
    
    $row_id = $row["id"];
    $sql_b = "SELECT * FROM category WHERE parent_id ='$row_id'";
    $count = mysqli_query($connect, $sql_b);
    if ($count->num_rows > 0) {
      $menu .= tree_4_adding($connect, $row["id"],$for,$level+1);
    }
  }
  
  return $menu;
}

//admin login functions
function getIpAddr()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ipAddr = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipAddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ipAddr = $_SERVER['REMOTE_ADDR'];
  }
  return $ipAddr;
}

function findip($ip, $conn)
{
  $sql = "SELECT * FROM logintry WHERE ip='$ip'";
  $result = mysqli_query($conn, $sql); //fire query to the mysql DB
  $count = mysqli_num_rows($result);
  return $count;
}
function getTry($ip, $conn)
{
  $sql = "SELECT try FROM logintry WHERE ip='$ip'";
  $result = mysqli_query($conn, $sql); //fire query to the mysql DB
  $row = mysqli_fetch_assoc($result);
  return $row['try'];
}
function timediffmiuntes($ip, $ctime, $conn)
{
  $sql = "SELECT ltime FROM logintry WHERE ip='$ip'";
  $result = mysqli_query($conn, $sql); //fire query to the mysql DB
  $row = mysqli_fetch_assoc($result);
  $oldtime =  $row['ltime'];
  $tdiff = $ctime - $oldtime;
  $minutes = $tdiff / 60 % 60;
  return $minutes;
}
function ipexist($ip, $conn)
{
  $sql = "SELECT ip FROM logintry WHERE ip='$ip'";
  $result = mysqli_query($conn, $sql); //fire query to the mysql DB
  $count = mysqli_num_rows($result);
  return $count;
}
//logout if user is inactive for a time period
function set_timeout()
{
  $expiretime = 30; // Session expire if inactive user
  $_SESSION['last_activity'] = time(); //your last activity was now, having logged in.
  $_SESSION['expire_time'] = $expiretime * 60; //expire time in minutes: three hours 3*60*60 (you must change this)
}
function session_timeout()
{
  if ($_SESSION['last_activity'] < time() - $_SESSION['expire_time']) { //have we expired?
    //redirect to logout.php
    header('Location: logout.php'); //change yoursite.com to the name of you site!!
  } else { //if we haven't expired:
    $_SESSION['last_activity'] = time(); //this was the moment of last activity.
  }
}

//Generate Strong Password
function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
{
  $sets = array();
  if (strpos($available_sets, 'l') !== false)
    $sets[] = 'abcdefghjkmnpqrstuvwxyz';
  if (strpos($available_sets, 'u') !== false)
    $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
  if (strpos($available_sets, 'd') !== false)
    $sets[] = '23456789';
  if (strpos($available_sets, 's') !== false)
    $sets[] = '!@#$%&*?';

  $all = '';
  $password = '';
  foreach ($sets as $set) {
    $password .= $set[array_rand(str_split($set))];
    $all .= $set;
  }

  $all = str_split($all);
  for ($i = 0; $i < $length - count($sets); $i++)
    $password .= $all[array_rand($all)];

  $password = str_shuffle($password);

  if (!$add_dashes)
    return $password;

  $dash_len = floor(sqrt($length));
  $dash_str = '';
  while (strlen($password) > $dash_len) {
    $dash_str .= substr($password, 0, $dash_len) . '-';
    $password = substr($password, $dash_len);
  }
  $dash_str .= $password;
  return $dash_str;
}
//Generate Strong Password
//admin login functions
function getImagebyID($conn, $id)
{
  $sql = "SELECT img1 from images_tb where img_id = '$id'";
  $result = mysqli_query($conn, $sql); //fire query to the mysql DB
  $row = mysqli_fetch_assoc($result);
  return $row['img1'];
}
