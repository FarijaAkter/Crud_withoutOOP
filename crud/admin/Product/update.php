<?php
session_start();
$approot= $_SERVER['DOCUMENT_ROOT'].'/crud/';
$filename='IMG_'.time().'_'.$_FILES['picture']['name'];

if($_FILES['picture']['name'] != ''){
    $target= $_FILES['picture']['tmp_name'];
    $destination= $approot."uploads/".$filename;

    $is_file_moved=move_uploaded_file($target,$destination);

    if($is_file_moved){
        $_picture = $filename;
    }else{
        $_picture = null;
    }
}else{
    $_picture = $_POST['old-picture'];
}

$_id = $_POST['id'];
$_title = $_POST['title'];
if(array_key_exists('is_draft', $_POST)){
    $_is_draft = $_POST['is_draft'];
}else{
    $_is_draft = 0;
}
$_description = $_POST['description'];
//$_picture = $_POST['picture'];
$_modified_at =date('Y-m-d H:i:s',time());
if(array_key_exists('is_active', $_POST)){
    $_is_active = $_POST['is_active'];
}else{
    $_is_active = 0;
}
if(array_key_exists('is_deleted', $_POST)){
    $_is_deleted = $_POST['is_deleted'];
}else{
    $_is_deleted  = 0;
}

//Connect to Database using PDO
$username = "root";
$password = "";

$conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//INSERT QUERY
$query = "UPDATE `products` SET `id` = :id, `title` = :title, `is_draft` = :is_draft,`description` = :description,`is_active` = :is_active,`is_deleted` = :is_deleted,`picture` = :picture, `modified_at` = :modified_at  WHERE `products`.`id` =:id;";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $_id);
$stmt->bindParam(':title', $_title);
$stmt->bindParam(':is_draft', $_is_draft);
$stmt->bindParam(':description', $_description);
$stmt->bindParam(':is_active', $_is_active);
$stmt->bindParam(':is_deleted', $_is_deleted);
$stmt->bindParam(':picture', $_picture);
$stmt->bindParam(':modified_at', $_modified_at);

$result = $stmt->execute();
if($result){
    $_SESSION['message']="The Product is updated successfully.";
}else{
    $_SESSION['message']="The Product is not updated successfully.";
}
header("location:index.php");
?>





