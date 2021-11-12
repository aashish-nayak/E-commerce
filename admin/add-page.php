<?php
include 'include/connect.php';
include 'include/functions.php';
checkSession();
$user = currentuser($conn,$_SESSION['user_id']);// this Function Return a Assoc Array of Current User
if($user['role']=="manage_enquiry"){
    header("Location: dashboard.php");
    $_SESSION['error'] = "You Do Not have Permission to Access this Page";
}
$error = "";
if (isset($_POST["submit"])) {
    $title = strip_tags(trim($_POST["title"]));
    $url = strip_tags(strtolower(trim($_POST["page-url"])));
    $url = preg_replace('/\s+/', '-', $url);
    $status = $_POST["status"]; 
    $cat_type = $_POST["cat_type"];
    $order = $_POST["order"];
    $textarea = $_POST["textarea"];
    if (!isset($_GET['edit'])) {
        $result = countPage($conn, $page,'url',$url);
        if ($result > 0) {
            $error = "URL Already Exist";
        } else {
            $insert = "INSERT INTO $page(title ,url ,status ,cat_type ,page_order ,description )VALUES('$title','$url','$status','$cat_type','$order','$textarea')";
            $hitinsert = mysqli_query($conn,$insert);
        }
        $lastidArr = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM $page ORDER BY id DESC LIMIT 1"));
        $last_id = $lastidArr['id'];
        $img1 = imgupload('img1');
        $img2 = imgupload('img2');
        $img3 = imgupload('img3');
        $img4 = imgupload('img4');
        $img5 = imgupload('img5');
        $insert = "INSERT INTO $pageImg(img_id ,img1 ,img2 ,img3 ,img4 ,img5)VALUES('$last_id','$img1','$img2','$img3','$img4','$img5')";
        $hitinsert = mysqli_query($conn,$insert);
        header("Location: add-page.php");
    } else {
        $id = $_GET['edit'];
        $cat = $_GET['cat'];
        $update = "UPDATE $page SET title='$title',url='$url',status='$status',page_order='$order',description='$textarea' WHERE id='$id'";
        $hitupdate = mysqli_query($conn,$update);
        updateImg($conn,'img1',$id);        
        updateImg($conn,'img2',$id);        
        updateImg($conn,'img3',$id);        
        updateImg($conn,'img4',$id);        
        updateImg($conn,'img5',$id);   
        header("Location: view-pages.php?view=$cat");    
    }
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editrow = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM $page Where id='$id'"));

    $editImg = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM $pageImg Where img_id='$id'"));
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Add Product - Khaintan Orfin</title>
    <?php include "include/head-links.php"; ?>
    <script src="./assets/ckeditor/ckeditor.js"></script>
</head>

<body>
    
    <div id="preloader">
        <div class="loader"></div>
    </div>
    
    
    <div class="page-container">
        <?php include "include/sidebar.php" ?>
        
        <div class="main-content">
            <?php include "include/header-area.php" ?>
            <div class="main-content-inner">
                <div class="main-content-inner">
                    <div class="row">
                        <div class="col-lg-12 col-ml-12">
                            <div class="row">
                                <div class="col-12 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            
                                            <form class="needs-validation" action="" method="POST" role="form"
                                                enctype="multipart/form-data">
                                                <div class="form-row">
                                                    <div class="col-md-2 mb-3">
                                                        <label for="validationCustom01">ID : </label>
                                                        <input type="text" disabled class="form-control"
                                                            value="<?php if (isset($_GET['edit'])) { echo $editrow['id']; } ?>"
                                                            id="validationCustom01">
                                                    </div>
                                                    <div class="col-md-2 mb-3">
                                                        <label>Page Status </label>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio"
                                                                <?php if (isset($_GET['edit'])) { if ($editrow['status'] == '1') echo "checked"; } ?>
                                                                required id="customRadio1" name="status" value="1"
                                                                class="custom-control-input">
                                                            <label class="custom-control-label"
                                                                for="customRadio1">Active</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio"
                                                                <?php if (isset($_GET['edit'])) { if ($editrow['status'] == '0') echo "checked"; } ?>
                                                                required id="customRadio2" name="status" value="0"
                                                                class="custom-control-input">
                                                            <label class="custom-control-label"
                                                                for="customRadio2">Disabled</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mr-3 mb-3">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Category</label>
                                                            <input type="hidden" id="edit" name="edit" value="<?php if(isset($_GET['edit'])){ echo $editrow['cat_type'];}?>">
                                                            <select class="form-control" name="cat_type">
                                                                <?php echo tree_4_adding($conn,0,'cat_url');?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 mb-3">
                                                        <label for="validationCustomUsername">Page Order:</label>
                                                        <input class="form-control" min="0" type="number" required
                                                            name="order"
                                                            value="<?php if (isset($_GET['edit'])) { echo $editrow['page_order'];} ?>"
                                                            id="example-number-input">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" placeholder="Title" required name="title"
                                                            value="<?php if (isset($_GET['edit'])) { echo $editrow['title'];} ?>"
                                                            class="form-control" id="validationCustom03">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" placeholder="URL" required
                                                            value="<?php if (isset($_GET['edit'])) { echo $editrow['url']; } ?>"
                                                            name="page-url" class="form-control"
                                                            id="validationCustom03">
                                                        <span class="text-danger"><?php echo $error; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="input-group col mb-3">
                                                        <div class="mb-3 preview"
                                                            style="background-image: url('uploads/<?php if (isset($_GET['edit'])) { echo $editImg['img1']; } ?>');">

                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" onchange="previewImg(this);"  accept="image/*" name="img1" class="custom-file-input" id="img1">
                                                            <label class="custom-file-label" for="img1">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                    <div class="input-group col mb-3">
                                                        <div class="mb-3 preview"
                                                            style="background-image: url('uploads/<?php if (isset($_GET['edit'])) { echo $editImg['img2']; } ?>');">

                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" accept="image/*" name="img2" onchange="previewImg(this);" class="custom-file-input" id="img2">
                                                            <label class="custom-file-label" for="img2">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <div class="input-group col mb-3">
                                                        <div class="mb-3 preview"
                                                            style="background-image: url('uploads/<?php if (isset($_GET['edit'])) { echo $editImg['img3']; } ?>');">

                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" accept="image/*" name="img3" onchange="previewImg(this);" class="custom-file-input" id="img3">
                                                            <label class="custom-file-label" for="img3">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                    <div class="input-group col mb-3">
                                                        <div class="mb-3 preview"
                                                            style="background-image: url('uploads/<?php if (isset($_GET['edit'])) { echo $editImg['img4']; } ?>');">

                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" onchange="previewImg(this);" accept="image/*" name="img4" class="custom-file-input" id="img4">
                                                            <label class="custom-file-label" for="img4">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                    <div class="input-group col mb-3">
                                                        <div class="mb-3 preview"
                                                            style="background-image: url('uploads/<?php if (isset($_GET['edit'])) { echo $editImg['img5']; } ?>');">

                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" accept="image/*" name="img5" onchange="previewImg(this);" class="custom-file-input" id="img5">
                                                            <label class="custom-file-label" for="img5">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <textarea name="textarea" id='ckeditor'
                                                            placeholder="Write Description here..." class="form-control" cols="0"
                                                            rows="10"><?php if (isset($_GET['edit'])) { echo $editrow['description']; } ?></textarea>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" name="submit"
                                                    type="submit">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <footer>
                <div class="footer-area">
                    <p>Powered By: <a href="https://www.maxfizz.com" target="_blank">MaxFizz</a></p>
                </div>
            </footer>
            
        </div>
        
        <?php include "include/footer-table.php" ?>
        <script>
        function previewImg(input) {
            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(input).parent().prev().attr('style', 'background-image:url("' + e.target.result + '")');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        CKEDITOR.replace('ckeditor');
        </script>
</body>

</html>