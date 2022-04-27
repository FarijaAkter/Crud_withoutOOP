<?php
/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/
session_start();

$_id = $_POST['id'];
$_name = $_POST['name'];
$_email = $_POST['email'];
$_subject = $_POST['subject'];
//echo $_name;

//Connect to database
$conn = new PDO("mysql:host=localhost;dbname=ecommerce",
    'root', '');
//set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);
$query = "UPDATE `contacts` SET `name` = :name, 
                               `email` = :email, 
                               `subject` = :subject
          WHERE `contacts`.`id` = :id";

$stmt = $conn->prepare($query);

$stmt->bindParam(':id', $_id);
$stmt->bindParam(':name', $_name);
$stmt->bindParam(':email', $_email);
$stmt->bindParam(':subject', $_subject);

$result = $stmt->execute();

//var_dump($result);

if ($result){
    $_SESSION['message'] = "Contact is updated successfully";
}else{
    $_SESSION['message'] = "Contact is not updated";
}

// this is for the location set to store.php to main home page index.php
header("location:index.php");
?>


