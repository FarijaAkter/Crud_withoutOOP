<?php
session_start();
//echo $_SERVER['DOCUMENT_ROOT'].'/crud/';
$approot=$_SERVER['DOCUMENT_ROOT'].'/crud/';
//die();

/* echo"<pre>";
 print_r($_POST);
 echo"</pre>";*/
$_title=$_POST['title'];
$_created_at = date('Y-m-d H:i:s', time());

if(array_key_exists('is_active',$_POST)){
    $_is_active=$_POST['is_active'];
}else{
    $_is_active=0;
}
if(array_key_exists('is_deleted',$_POST)){
    $_is_deleted=$_POST['is_deleted'];
}else{
    $_is_deleted=0;
}
//var_dump($_POST);
$filename='IMG_'.time().'_'.$_FILES['picture']['name'];
$target= $_FILES['picture']['tmp_name'];
$destination=$approot."uploads/".$filename;
$is_file_moved= move_uploaded_file($target,$destination);

if($is_file_moved){
    $_picture=$filename;
}else{
    $_picture= null;
}

$username = "root";
$password = "";

    $conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

    $query="INSERT INTO `banners` (`title`,`is_active`,`is_deleted`,`created_at`,`picture`) VALUES ( :title, :is_active, :is_deleted, :created_at, :picture);";
    $stmt=$conn->prepare($query);
    $stmt->bindParam(':title',$_title);
    $stmt->bindParam(':is_active',$_is_active);
$stmt->bindParam(':is_deleted',$_is_deleted);
$stmt->bindParam(':created_at',$_created_at);
    $stmt->bindParam(':picture',$_picture);
    $result=$stmt->execute();
if($result){
    $_SESSION['message']="The Banner is added successfully.";
}else{
    $_SESSION['message']="The Banner is not added successfully.";
}
header("location:index.php");
?>