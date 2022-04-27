<?php
session_start();
//echo $_SERVER['DOCUMENT_ROOT'].'/crud/';
//die();
$approot= $_SERVER['DOCUMENT_ROOT'].'/crud/';
//$_picture = $_POST['picture'];

$filename='IMG_'.time().'_'.$_FILES['picture']['name'];

$target= $_FILES['picture']['tmp_name'];
$destination= $approot."uploads/".$filename;

$is_file_moved=move_uploaded_file($target,$destination);

if($is_file_moved){
    $_picture = $filename;
}else{
    $_picture = null;
}

$_title = $_POST['title'];
if(array_key_exists('is_draft', $_POST)){
    $_is_draft = $_POST['is_draft'];
}else{
    $_is_draft = 0;
}
$_description = $_POST['description'];
$_is_active = $_POST['is_active'];

$_created_at =date('Y-m-d H:i:s',time());

if(array_key_exists('is_active', $_POST)){
    $_is_active = $_POST['is_active'];
}else{
    $_is_active = 0;
}
if(array_key_exists('is_deleted', $_POST)){
    $_is_deleted  = $_POST['is_deleted'];
}else{
    $_is_deleted = 0;
}
//Connect to Database using PDO
$username = "root";
$password = "";

$conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//INSERT QUERY
$query = "INSERT INTO `products` (`title`,`is_draft`,`description`,`is_active`,`is_deleted`,`picture`,`created_at`) VALUES (:title , :is_draft ,:description, :is_active, :is_deleted , :picture, :created_at );";
$stmt=$conn->prepare($query);

$stmt->bindParam(':title', $_title);
$stmt->bindParam(':is_draft', $_is_draft);
$stmt->bindParam(':description', $_description);
$stmt->bindParam(':is_active', $_is_active);
$stmt->bindParam(':is_deleted', $_is_deleted);
$stmt->bindParam(':picture', $_picture);
$stmt->bindParam(':created_at', $_created_at);


$result = $stmt->execute();

if($result){
    $_SESSION['message']="The Product is added successfully.";
}else{
    $_SESSION['message']="The Product is not added successfully.";
}
header("location:index.php");