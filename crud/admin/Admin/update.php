<?php
$_id=$_POST['id'];
$_name=$_POST['name'];
$_email=$_POST['email'];
$_password=$_POST['password'];
$_phone=$_POST['phone'];
$conn = new PDO("mysql:host=localhost;dbname=ecommerce",
    'root', '');
//set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);

$query="UPDATE `admins` SET `id` = :id, `name` = :name, `email` = :email, `password` = :password, `phone` = :phone WHERE `admins`.`id` = :id;";
$stmt=$conn->prepare($query);
$stmt->bindParam(':id',$_id);
$stmt->bindParam(':name',$_name);
$stmt->bindParam(':email',$_email);
$stmt->bindParam(':password',$_password);
$stmt->bindParam(':phone',$_phone);
$result=$stmt->execute();
header("location:index.php")

?>