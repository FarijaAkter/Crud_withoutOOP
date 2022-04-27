<?php
session_start();
//echo $_SERVER['DOCUMENT_ROOT'].'/crud/';
//die();

$_fullname = $_POST['fullname'];
$_username = $_POST['username'];
$_email = $_POST['email'];
$_phone = $_POST['phone'];
$_password = $_POST['password'];


if(array_key_exists('is_deleted', $_POST)){
    $_is_deleted  = $_POST['is_deleted'];
}else{
    $_is_deleted = 0;
}

$_created_at =date('Y-m-d H:i:s',time());


//Connect to Database using PDO
$username = "root";
$password = "";

$conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//INSERT QUERY
$query = "INSERT INTO `users` ( `fullname`, `username`, `email`, `phone`, `password`, `is_deleted`, `created_at`) VALUES ( :fullname, :username, :email, :phone, :password, :is_deleted, :created_at);";

$stmt=$conn->prepare($query);

$stmt->bindParam(':fullname', $_fullname);
$stmt->bindParam(':username', $_username);
$stmt->bindParam(':email', $_email);
$stmt->bindParam(':phone', $_phone);
$stmt->bindParam(':password', $_password);
$stmt->bindParam(':is_deleted', $_is_deleted);
$stmt->bindParam(':created_at', $_created_at);


$result = $stmt->execute();

if($result){
    $_SESSION['message']="The Product is added successfully.";
}else{
    $_SESSION['message']="The Product is not added successfully.";
}
header("location:index.php");