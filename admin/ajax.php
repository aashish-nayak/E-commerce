<?php
include 'include/connect.php';
include 'include/functions.php';
checkSession();
$user = currentuser($conn,$_SESSION['user_id']);// this Function Return a Assoc Array of Current User
if ($_POST['operation'] == 'status') {
    $type = $_POST['operation'];
    $table = $_POST['table'];
    if ($type == 'status') {
        $operation = $_POST['status'];
        $id = $_POST['id'];
        if ($operation == 'Active') {
            $status = 1;
        } else {
            $status = 0;
        }
        mysqli_query($conn,"UPDATE $table SET status='$status' WHERE id='$id'");
        echo $operation;
    }
}

// if ($_POST['operation'] == 'load') {
//     $result = selectQuery($conn, '*', 'gallery','','','ORDER BY','img_order DESC');
//     if (count($result) > 0) {
//         $output = "";
//         for ($i = 0; $i < count($result); $i++) {
//             $output .= '<tr role="row" >
//             <td>' . $i. '</td>
//             <td><img src="' . $result[$i]['image'] . '" style="height:80px;" alt="" srcset=""></td>
//             <td style="width:200px;cursor:pointer;" data-toggle="tooltip" data-placement="bottom" title="Edit Order" class="edit" data-edit="' . $result[$i]['id'] . '">' . $result[$i]['img_order'] . '</td>
//             <td><a href="" data-delete="' . $result[$i]['id'] . '" data-toggle="tooltip" data-placement="bottom" title="Delete" class="del-img ti-trash text-danger"></a></td>
//         </tr>';
//         }
//         echo $output;
//     }
// }

// if ($_POST['operation'] == 'insert') {
//     $Arr = imgupload('img', true, 'gallery/');
//     $count = selectQuery($conn,'img_order','gallery','','','ORDER BY','img_order DESC',1);
//     $order = $count[0]['img_order'];
//     for ($i = 0; $i < count($Arr); $i++) {
//         $insert = ['image' => $Arr[$i], 'img_order' => $i+1+$order];
//         $Inresult = insertQuery($conn, 'gallery', $insert);
//     }
//     echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style=" position: fixed; top: 20%;right: 2%;">
//     <strong style="margin-right: 25px;">Image Uploaded Successfully</strong><button type="button" class="close" style="padding: 7px 10px;" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
// }

// if ($_POST['operation'] == 'delete') {
//     $id = $_POST['id'];
//     delImg($conn, 'gallery','uploads/', "image", 'id', $id);
//     $resultDel = delQuery($conn, 'gallery', 'id', $id);
//     if ($resultDel == 1) {
//         echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style=" position: fixed; top: 20%;right: 2%;">
//     <strong style="margin-right: 25px;">Data Deleted Successfully</strong><button type="button" class="close" style="padding: 7px 10px;" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
//     } else {
//         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style=" position: fixed; top: 20%;right: 2%;">
//     <strong style="margin-right: 25px;">Data Can Not Deleted</strong><button type="button" class="close" style="padding: 7px 10px;" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
//     }
// }

// if ($_POST['operation'] == 'deleteall') {
//     delImg($conn, 'gallery','uploads/',"image");
//     $resultDel = delQuery($conn, 'gallery');
//     if ($resultDel == 1) {
//         echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style=" position: fixed; top: 20%;right: 2%;">
//     <strong style="margin-right: 25px;">All Data Deleted Successfully</strong><button type="button" class="close" style="padding: 7px 10px;" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
//     } else {
//         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style=" position: fixed; top: 20%;right: 2%;">
//     <strong style="margin-right: 25px;">All Data Can Not Deleted</strong><button type="button" class="close" style="padding: 7px 10px;" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
//     }
// }

// if ($_POST['operation'] == 'update') {
//     $id = $_POST['id'];
//     $order = $_POST['input'];
//     $data = ['img_order' => $order];
//     $result = updateQuery($conn, 'gallery', $data, 'id', $id);
//     if (!$result == 0) {
//         echo 1;
//     } else {
//         echo 0;
//     }
// }
?>