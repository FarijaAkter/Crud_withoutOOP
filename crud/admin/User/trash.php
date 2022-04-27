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

$query = "UPDATE `users` SET `is_deleted` = :is_deleted WHERE `users`.`id` =:id;";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id',$_id);
$stmt->bindParam(':is_deleted',$_is_deleted);

$result = $stmt->execute();
if($result){
    $_SESSION['message']="The User is successfully in trash .";
}else{
    $_SESSION['message']="The User is not in trash.";
}
header("location:index.php");
?>