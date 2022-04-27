<?php
session_start();

$_id = $_POST['id'];
$_fullname = $_POST['fullname'];
$_username = $_POST['username'];
$_email= $_POST['email'];
$_phone= $_POST['phone'];
$_password= $_POST['password'];
if(array_key_exists('is_deleted', $_POST)){
    $_is_deleted = $_POST['is_deleted'];
}else{
    $_is_deleted  = 0;
}
$_modified_at =date('Y-m-d H:i:s',time());



//Connect to Database using PDO
$username = "root";
$password = "";

$conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//INSERT QUERY
$query = "UPDATE `users` SET `id` = :id, `fullname` = :fullname, `username` = :username, `email` = :email, `phone` = :phone, `password` = :password,`modified_at` = :modified_at WHERE `users`.`id` = :id;";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $_id);
$stmt->bindParam(':fullname', $_fullname);
$stmt->bindParam(':username', $_username);
$stmt->bindParam(':email', $_email);
$stmt->bindParam(':phone', $_phone);
$stmt->bindParam(':password', $_password);
$stmt->bindParam(':is_deleted', $_is_deleted);
$stmt->bindParam(':modified_at', $_modified_at);

$result = $stmt->execute();
if($result){
    $_SESSION['message']="The User is updated successfully.";
}else{
    $_SESSION['message']="The User is not updated successfully.";
}
header("location:index.php");
?>





