<?php
session_start();
$_id=$_GET['id'];

//var_dump($_GET);
//Connect to database
$conn = new PDO("mysql:host=localhost;dbname=ecommerce",
    'root', '');
//set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);
$query="DELETE FROM `admins` WHERE `admins`.`id` =:id";
$stmt=$conn->prepare($query);
$stmt->bindParam(':id',$_id);

$result=$stmt->execute();
if($result){
    $_SESSION['message']="The Banner is deleted successfully.";
}else{
    $_SESSION['message']="The Banner is not deleted successfully.";
}
header("location:index.php");

?>