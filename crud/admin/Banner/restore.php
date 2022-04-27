<?php
session_start();
//$_id=1;
$_id=$_GET['id'];
//var_dump($_GET);
$_is_deleted = 0;
$username = "root";
$password = "";

$conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "Connected successfully";

$query= "UPDATE `banners` SET  `is_deleted` = :is_deleted  WHERE `banners`.`id` = :id;";
//$query= "DELETE FROM `banners` WHERE `banners`.`id` = 1";
$stmt=$conn->prepare($query);
$stmt->bindParam(':id',$_id);
$stmt->bindParam(':is_deleted',$_is_deleted);
$result=$stmt->execute();
if($result){
    $_SESSION['message']="The Banner is deleted successfully.";
}else{
    $_SESSION['message']="The Banner is not deleted successfully.";
}
header("location:index.php");