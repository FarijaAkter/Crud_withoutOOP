<?php
session_start();
$_id=$_GET['id'];
$_is_deleted = 1;
//var_dump($_GET);
$username = "root";
$password = "";

    $conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

$query = "UPDATE `products` SET `is_deleted` = :is_deleted WHERE `products`.`id` =:id;";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id',$_id);
$stmt->bindParam(':is_deleted',$_is_deleted);

$result = $stmt->execute();
if($result){
    $_SESSION['message']="The Product is successfully in trash .";
}else{
    $_SESSION['message']="The Product is not in trash.";
}
header("location:index.php");
?>