<?php
$_id=$_GET['id'];
$_is_deleted = 0;
var_dump($_GET);
//Connect to Database using PDO
$username = "root";
$password = "";
$conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query=  "UPDATE `carts` SET `is_deleted` = :is_deleted        
                              WHERE `carts`.`id` =:id";
$stmt=$conn->prepare($query);
$stmt->bindParam(':id',$_id);
$stmt->bindParam(':is_deleted',$_is_deleted);
$result=$stmt->execute();
if($result){
    $_SESSION['message'] = "Cart is deleted successfully";
}else{
    $_SESSION['message'] = "Cart is not deleted successfully";
}
header("location:index.php");

