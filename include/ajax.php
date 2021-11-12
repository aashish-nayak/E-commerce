<?php
include "../admin/include/connect.php";
include "../admin/include/functions.php";
session_start();
// ============== Ajax Live Search Engine =======================
if (isset($_POST['query'])) {
    $output = "";
    $search = $_POST['query'];
    $sql = mysqli_query($conn, "SELECT * FROM page WHERE title LIKE '%$search%' OR description LIKE '%$search%'");
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '<li class="list" title="' . $row['title'] . '">' . limitstring($row['title'], 11) . '</li>';
        }
        echo $output;
    }
}
if (isset($_POST['operation']) && $_POST['operation'] == 'view') {
    $id = $_POST['id'];
    $imgs = [];
    $sql = mysqli_query($conn, "SELECT * FROM page WHERE id='$id'");
    $img = mysqli_query($conn, "SELECT * FROM images_tb WHERE img_id='$id'");
    $row = mysqli_fetch_assoc($sql);
    $img_row = mysqli_fetch_assoc($img);
    for ($i = 1; $i <= 5; $i++) {
        if ($img_row['img' . $i . ''] != "") {
            array_push($imgs, $img_row['img' . $i . '']);
        }
    }
    $arr = array_merge($row, $imgs);
    echo json_encode($arr);
}

if (isset($_POST['operation']) && $_POST['operation'] == 'add-to-cart') {
    error_reporting(0);
    // session_destroy();
    $id = $_POST['item'];
    $qty = $_POST['qty'];
    if (isset($_SESSION['login_id'])) {
        $u_id = $_SESSION['login_id'];
        $select = mysqli_query($conn, "SELECT * FROM cart WHERE customer_id='$u_id' AND item_id='$id'");
        if (mysqli_num_rows($select) > 0) {
            $itemup = mysqli_fetch_assoc($select);
            $item_id = $itemup['item_id'];
            $update = "UPDATE cart SET item_id='$id',qty='$qty' WHERE customer_id='$u_id' AND item_id='$item_id'";
            $res = mysqli_query($conn, $update);
        } else {
            $date = date("Y-m-d");
            $insert = "INSERT INTO cart (customer_id,item_id,qty,add_date)VALUES('$u_id','$id','$qty','$date')";
            $res = mysqli_query($conn, $insert);
        }
    } else {
        $_SESSION['cart'][$id]['qty'] = $qty;
    }
    echo json_encode(array_filter($_SESSION['cart']));
}
if (isset($_POST['operation']) && $_POST['operation'] == 'view-cart') {
    $html = "";
    $carthtml = "";
    $checkhtml = "";
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }
    $arr = [];
    if (isset($_SESSION['login_id'])) {
        $viewcart = mysqli_query($conn,"SELECT * FROM cart WHERE customer_id='{$_SESSION['login_id']}'");
        if(mysqli_num_rows($viewcart)>0){
            while($row = mysqli_fetch_assoc($viewcart)){
                $arr[].=$row['item_id'];
                $arr[$row['item_id']]['qty'] = $row['qty']; //Problem is Here Fix this 
            }
        }
    } else {
        $arr = $_SESSION['cart'];
    }
    foreach ($arr as $key => $value) {
        $query = mysqli_query($conn, "SELECT title,url,price FROM page WHERE id='$key'");
        $img = mysqli_query($conn, "SELECT img1 FROM images_tb WHERE img_id='$key'");
        $row = mysqli_fetch_assoc($query);
        $img_row = mysqli_fetch_assoc($img);
        $html .= '<li><a href="#" class="minicart-product-image"><img src="admin/uploads/' . $img_row['img1'] . '" alt="FBs Thumbnail"><span class="product-quantity">' . $value['qty'] . '</span></a><div class="minicart-product-details"><h6><a href="page.php?url=' . $row['url'] . '">' . limitstring($row['title'], 3) . '</a></h6><span class="item-price" data-price="' . $row['price'] . '">₹ ' . $row['price'] . '</span></div><button class="close" title="Remove" onclick="delItem(' . $key . ');"><i class="fa fa-close"></i></button></li>';
        $carthtml .= '<tr>
        <td class="fb-product-remove" ><a href="javascript:void(0)" onclick="delItem(' . $key . ');" title="Remove"><i class="fa fa-times"></i></a>
        </td>
        <td class="fb-product-thumbnail"><a href="#"><img class="custom-cart-img" src="admin/uploads/' . $img_row['img1'] . '" alt="FBs Product Image"></a></td>
        <td class="fb-product-name"><a href="#">' . $row['title'] . '</a></td>
        <td class="fb-product-price"><span class="amount">₹ ' . $row['price'] . '</span></td>
        <td class="quantity">
            <label>Quantity</label>
            <div class="cart-plus-minus">
                <input class="cart-plus-minus-box" data-price="' . $row['price'] . '" data-itemId="' . $key . '" value="' . $value['qty'] . '" type="text">
                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
            </div>
        </td>
        <td class="product-subtotal"><span class="amount">₹ ' . $row['price'] * $value['qty'] . '</span></td>
    </tr>';
        $checkhtml .= '<tr class="cart_item">
    <td class="cart-product-name" style="text-align:start;">' . limitstring($row['title'], 5) . '<strong
            class="product-quantity"> × ' . $value['qty'] . '</strong></td>
    <td class="cart-product-total"><span class="amount">₹ ' . $row['price'] * $value['qty'] . '</span></td>
    </tr>';
    }
    echo $html, "|", $carthtml, "|", $checkhtml;
    // prx($arr);
    
}
if (isset($_POST['operation']) && $_POST['operation'] == 'del-item') {
    $id = $_POST['id'];
    unset($_SESSION['cart'][$id]);
}
