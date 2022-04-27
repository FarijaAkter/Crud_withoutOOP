<?php
session_start();
$approot=$_SERVER['DOCUMENT_ROOT'].'/crud/';
/*echo"<pre>";
print_r($_POST);
echo"</pre>";*/
$filename='IMG_'.time().'_'.$_FILES['picture']['name'];
//var_dump($_POST);
if($_FILES['picture']['name'] != '' ){
    $target= $_FILES['picture']['tmp_name'];
    $destination=$approot."uploads/".$filename;
    $is_file_moved= move_uploaded_file($target,$destination);

    if($is_file_moved){
        $_picture=$filename;
    }else{
        $_picture= null;
    }
}else{
    $_picture=$_POST['old-picture'];
}
$_id = $_POST['id'];
$_sid = $_POST['sid'];
$_product_id= $_POST['product_id'];
$_product_title= $_POST['product_title'];

if(array_key_exists('is_active',$_POST)){
    $_is_active=$_POST['is_active'];
}else{
    $_is_active=0;
}
if(array_key_exists('is_deleted',$_POST)){
    $_is_deleted=$_POST['is_deleted'];
}else{
    $_is_deleted=0;
}
$_qty=$_POST['qty'];
$_unite_price=$_POST['unite_price'];
$_total_price=$_POST['unite_price']*$_POST['qty'];
//Connect to Database using PDO
$username = "root";
$password = "";
$conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//INSERT QUERY
$query = "UPDATE `carts` SET `id` = :id, 
                            `sid` = :sid,
                             `product_id` = :product_id,
                             `product_title` = :product_title,
                             `is_active` = :is_active,
                             `is_deleted` = :is_deleted,
                             `qty` = :qty,
                             `unite_price` = :unite_price,
                             `total_price` = :total_price,
                             `picture` = :picture
                              WHERE `carts`.`id` =:id";
$stmt = $conn->prepare($query);

$stmt->bindParam(':id', $_id);
$stmt->bindParam(':sid', $_sid);
$stmt->bindParam(':product_id', $_product_id);
$stmt->bindParam(':product_title', $_product_title);
$stmt->bindParam(':is_active', $_is_active);
$stmt->bindParam(':is_deleted', $_is_deleted);
$stmt->bindParam(':qty', $_qty);
$stmt->bindParam(':unite_price', $_unite_price);
$stmt->bindParam(':total_price', $_total_price);
$stmt->bindParam(':picture', $_picture);

$result = $stmt->execute();
var_dump($result);
if($result){
    $_SESSION['message']="The cart is updated successfully.";
}else{
    $_SESSION['message']="The cart is not updated successfully.";
}
header("location:index.php");
?>





