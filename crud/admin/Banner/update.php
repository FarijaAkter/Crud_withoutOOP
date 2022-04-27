<?php
session_start();
$approot=$_SERVER['DOCUMENT_ROOT'].'/crud/';
//die();

/* echo"<pre>";
 print_r($_POST);
 echo"</pre>";*/

$filename='IMG_'.time().'_'.$_FILES['picture']['name'];
//var_dump($_POST);
if($_FILES['picture']['name'] != '' ){
    $target= $_FILES['picture']['tmp_name'];
    $destination=$approot."uploads/".$filename;
    $is_file_moved= move_uploaded_file($target,$destination);

    if($is_file_moved){
        $_picture=$filename;
    }else{
        $_picture= null;
    }
}else{
    $_picture=$_POST['old-picture'];
}
$_id=$_POST['id'];
$_title=$_POST['title'];

if(array_key_exists('is_active',$_POST)){
    $_is_active=$_POST['is_active'];
}else{
    $_is_active =0;
}

if(array_key_exists('is_deleted',$_POST)){
    $_is_deleted=$_POST['is_deleted'];
}else{
    $_is_deleted =0;
}

$_modified_at=date('Y-m-d H:i:s', time());

$username = "root";
$password = "";

$conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "Connected successfully";

$query="UPDATE `banners` SET `id` = :id, `title` = :title ,`is_active` = :is_active, `is_deleted` = :is_deleted,`modified_at` = :modified_at, `picture` = :picture  WHERE `banners`.`id` = :id;";

$stmt=$conn->prepare($query);
$stmt->bindParam(':id',$_id);
$stmt->bindParam(':title', $_title);
$stmt->bindParam(':is_active', $_is_active);
$stmt->bindParam(':is_deleted', $_is_deleted);
$stmt->bindParam(':modified_at', $_modified_at);
$stmt->bindParam(':picture', $_picture);
$result=$stmt->execute();
if($result){
    $_SESSION['message']="The Banner is updated successfully.";
}else{
    $_SESSION['message']="The Banner is not updated successfully.";
}
header("location:index.php");