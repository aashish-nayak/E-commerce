<?php
if($type=="cat"){
  $table = 'category';
  $id = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM $table WHERE cat_url='$url'"));
  $sql = "SELECT * FROM category WHERE parent_id='{$id['id']}'";
  if(mysqli_num_rows(mysqli_query($conn, $sql))>0){
   $result = mysqli_query($conn, $sql);
  }else{
   $result = mysqli_query($conn,"SELECT * FROM page WHERE cat_type='$url' AND status=1");
  }
  $per_page = 6;
 }else{
    $table = 'distributers';
    $sql= "SELECT * FROM $table";
    $result = mysqli_query($conn, $sql);
    $per_page = 6;
 }
$count=  mysqli_num_rows($result);

$pagi = ceil($count / $per_page);

$start = $page-1;
$start = $start *  $per_page;
?>
