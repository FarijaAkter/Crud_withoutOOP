<?php
session_start();
//$_id=1;
$_id=$_GET['id'];
//var_dump($_GET);
$username = "root";
$password = "";

$conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "Connected successfully";

$query= "DELETE FROM `banners` WHERE `banners`.`id` = :id";
//$query= "DELETE FROM `banners` WHERE `banners`.`id` = 1";
$stmt=$conn->prepare($query);
$stmt->bindParam(':id',$_id);

$result=$stmt->execute();
if($result){
    $_SESSION['message']="The Banner is deleted successfully.";
}else{
    $_SESSION['message']="The Banner is not deleted successfully.";
}
header("location:index.php");