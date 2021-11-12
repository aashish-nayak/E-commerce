<?php
include'include/connect.php';
include'include/functions.php';
checkSession();
$user = currentuser($conn,$_SESSION['user_id']);// this Function Return a Assoc Array of Current User
if($user['role']=="manage_enquiry"){
    header("Location: dashboard.php");
    $_SESSION['error'] = "You Do Not have Permission to Access this Page";
}
$error="";
if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $url = strip_tags(strtolower(trim($_POST["page-url"])));
    $url = preg_replace('/\s+/', '-', $url);
    $order = $_POST["order"];
    $textarea = $_POST["textarea"];
    $parent = $_POST["parent"];
    if(isset($_POST["home"])){
        $home = $_POST["home"];
    }else{
        $home = NULL;
    }

    if (!isset($_GET['edit'])) {
        $result = countPage($conn,$catTB,'cat_url',$url);
        if ($result > 0) {
            $error = "URL Already Exist";
        } else {
            $path = imgupload('main_img');
            $path2 = imgupload('bann_img');
            $path3 = imgupload('site_bann');
            echo $insert = "INSERT INTO $catTB(cat_name ,cat_url ,cat_order ,main_img ,banner_img,site_bann,parent_id,home,textarea)VALUES('$title','$url','$order','$path','$path2','$path3','$parent','$home','$textarea')";
            $hitinsert = mysqli_query($conn,$insert);
            header("Location: add-cat.php");
        }
    } else {
        $id = $_GET['edit'];
        $resultup = countPage($conn,$catTB,'cat_url',$url);
        if($resultup == 0){
            $updateQ = mysqli_fetch_assoc(mysqli_query($conn,"SELECT cat_url FROM $catTB WHERE id='$id'"));
            mysqli_query($conn,"UPDATE $page SET cat_type='$url' WHERE cat_type='{$updateQ['cat_url']}'");
        }
        $update = "UPDATE $catTB SET cat_name='$title',cat_url='$url',cat_order='$order',parent_id='$parent', home='$home',textarea='$textarea' WHERE id='$id'";
        $hitupdate = mysqli_query($conn,$update);
        $path = imgupload('main_img');
        $path2 = imgupload('bann_img');
        $path3 = imgupload('site_bann');
        if (!$path == false) {
            delImg($conn, $catTB,"main_img", 'id', $id);
            $imgup = "UPDATE $catTB SET main_img='$path' WHERE id='$id'";
            $imgupdate = mysqli_query($conn,$imgup);
        }
        if(!$path2 == false){
            delImg($conn, $catTB,"banner_img", 'id', $id);
            $imgup2 = "UPDATE $catTB SET banner_img='$path2' WHERE id='$id'";
            $imgupdate2 = mysqli_query($conn,$imgup2);
        }
        if(!$path3 == false){
            delImg($conn, $catTB,"site_bann", 'id', $id);
            $imgup3 = "UPDATE $catTB SET site_bann='$path3' WHERE id='$id'";
            $imgupdate3 = mysqli_query($conn,$imgup3);
        }
        header("Location: view-cat.php");
    }
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = "SELECT * FROM $catTB Where id='$id'";
    $resultedit = mysqli_query($conn,$edit);
    $editrow = mysqli_fetch_assoc($resultedit);
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Add Category - Khaintan Orfin</title>
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
                                                    <div class="col-md-5 mb-3">
                                                        <label for="validationCustom03">Category Name</label>
                                                        <input type="text" required name="title"
                                                            value="<?php if (isset($_GET['edit'])) {echo $editrow['cat_name'];} ?>"
                                                            class="form-control" id="validationCustom03">
                                                    </div>
                                                    <div class="col-md-5 mb-3">
                                                        <label for="validationCustom03">Category URL</label>
                                                        <input type="text" required
                                                        value="<?php if (isset($_GET['edit'])) {echo $editrow['cat_url'];} ?>"
                                                        name="page-url" class="form-control"
                                                        id="validationCustom03">
                                                        <span class="text-danger"><?php echo $error;?></span>
                                                    </div>
                                                    <div class="col-md-2 mb-3">
                                                        <label for="validationCustom03">Show to Home</label>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" <?php if (isset($_GET['edit'])) { if ($editrow['home'] == 1 && $editrow['parent_id']==0){echo "checked";}else{ echo 'disabled';} } ?>
                                                                required id="customRadio1" name="home" value="1"
                                                                class="custom-control-input">
                                                            <label class="custom-control-label"
                                                                for="customRadio1">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio"
                                                                <?php if (isset($_GET['edit'])) { if ($editrow['home'] ==0 && $editrow['parent_id']==0){ echo "checked";}else{ echo 'disabled';} } ?>
                                                                required id="customRadio2" name="home" value="0"
                                                                class="custom-control-input">
                                                            <label class="custom-control-label"
                                                                for="customRadio2">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="validationCustomUsername">Category Dropdown:</label>
                                                                    <input type="hidden" id="edit" name="edit" value="<?php if(isset($_GET['edit'])){ echo $editrow['parent_id'];}?>">
                                                                <select name="parent" class="form-control" onchange="disableIn(this);" id="select">
                                                                    <option value="0">Parent</option>
                                                                    <?php echo tree_4_adding($conn,0,'id');?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="validationCustomUsername">Category
                                                                    Order:</label>
                                                                <input class="form-control" min="0" type="number"
                                                                    required name="order"
                                                                    value="<?php if (isset($_GET['edit'])) { echo $editrow['cat_order']; } ?>"
                                                                    id="example-number-input">
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="validationCustom03">Textarea</label>
                                                                <textarea name="textarea"
                                                                    placeholder="Write Your Description"  class="form-control" cols="0"
                                                                    rows="8"><?php if (isset($_GET['edit'])) {echo $editrow['textarea'];} ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                <label class="mb-3 preview" id="preview" for="inputGroupFile01" style="background-image: url('uploads/<?php if (isset($_GET['edit'])) { echo $editrow['main_img']; } ?>');">
                                                                <?php if (!isset($_GET['edit'])) {?> <label for="inputGroupFile01" ><h6>Category Image </h6><p>(Size - 1:1 Ratio)</p></label> <?php }?>
                                                                </label>
                                                                <input type="file" accept="image/*" hidden onchange="previewImg(this);" name="main_img" class="custom-file-input" id="inputGroupFile01">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="col mb-3 preview" for="bannImg" id="preview2" style="background-image: url('uploads/<?php if (isset($_GET['edit'])) { echo $editrow['banner_img']; } ?>');">
                                                                <?php if (!isset($_GET['edit'])) {?><label for="bannImg"><h6>Category Banner</h6>
                                                                    <p>(Size - 2:4 Ratio)</p></label> <?php }?>
                                                                </label>
                                                                <input type="file" accept="image/*" hidden onchange="previewImg2(this);" name="bann_img" class="custom-file-input" id="bannImg">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="col mb-3 preview" for="sitebann" id="preview3" style="background-image: url('uploads/<?php if (isset($_GET['edit'])) { echo $editrow['site_bann']; } ?>');">
                                                                <?php if (!isset($_GET['edit'])) {?><label for="sitebann"><h6>Site Banner</h6>
                                                                    <p>(Size - 6:1 Ratio)</p></label><?php }?>
                                                                </label>
                                                                <input type="file" accept="image/*" hidden onchange="previewImg3(this);" name="site_bann" class="custom-file-input" id="sitebann">
                                                            </div>
                                                        </div>
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
            
        </div>
        
        
        <footer>
            <div class="footer-area">
                <p>Powered By: <a href="https://www.maxfizz.com" target="_blank">MaxFizz</a></p>
            </div>
        </footer>
        
        <?php include "include/footer-table.php" ?>
        <script>
        function previewImg(input) {
            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#preview").html('');
                    $("#preview").attr('style', 'background-image:url("'+e.target.result+'")');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewImg2(input) {
            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#preview2").html('');
                    $("#preview2").attr('style', 'background-image:url("'+e.target.result+'")');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewImg3(input) {
            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#preview3").html('');
                    $("#preview3").attr('style', 'background-image:url("'+e.target.result+'")');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function disableIn(input){
            if(input.value!=0){
                $('#bannImg').attr('disabled','disabled');
                $('#sitebann').attr('disabled','disabled');
                $('#customRadio1').attr('disabled','disabled');
                $('#customRadio2').attr('disabled','disabled');
                $('#customRadio1').removeAttr('checked','checked');
                $('#customRadio2').removeAttr('checked','checked');
                $('#preview2').css('background','#e0e0e0');
                $('#preview2').html('<div class="w-100 text-center"><h5>Image Disabled </h5><br><p>(only for Parent)</p></div>');
                $('#preview3').css('background','#e0e0e0');
                $('#preview3').html('<div class="w-100 text-center"><h5>Image Disabled </h5><br><p>(only for Parent)</p></div>');
            }else{
                $('#bannImg').removeAttr('disabled','disabled');
                $('#sitebann').removeAttr('disabled','disabled');
                $('#customRadio1').removeAttr('disabled','disabled');
                $('#customRadio2').removeAttr('disabled','disabled');
                $('#preview2').html('<label for="bannImg"><h6>Category Banner</h6> <p>(Size - 2:4 Ratio)</p></label>');
                $('#preview2').css('background','#ffffff');
                $('#preview3').html('<label for="bannImg"><h6>Site Banner</h6> <p>(Size - 6:1 Ratio)</p></label>');
                $('#preview3').css('background','#ffffff');
            }
        }
        $(document).ready(function(){
            var id = $('#edit').val();
            var select = $('#select').children();
            select.each(function(index,val) { 
                if(id==$(val).val()){
                    $(this).attr('selected','selected');
                }
             })
        });
        </script>
</body>

</html>