<?php
/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/
$_name=$_POST['name'];
//echo $_name;
$_email=$_POST['email'];
//echo $_email;
$_password=$_POST['password'];
//echo $_password;
$_phone=$_POST['phone'];
//echo $_phone;
//Connect to database
$conn = new PDO("mysql:host=localhost;dbname=ecommerce",
    'root', '');
//set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);

$query="INSERT INTO `admins` ( `name`, `email`, `password`, `phone`) VALUES ( :name, :email , :password, :phone);";

$stmt=$conn->prepare($query);
$stmt->bindParam(':name',$_name);
$stmt->bindParam(':email',$_email);
$stmt->bindParam(':password',$_password);
$stmt->bindParam(':phone',$_phone);
$result=$stmt->execute();
header("location:index.php");
?>

