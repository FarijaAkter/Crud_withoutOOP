<?php
session_start();
$approot=$_SERVER['DOCUMENT_ROOT'].'/crud/';
/*echo"<pre>";
print_r($_POST);
echo"</pre>";*/
$_sid=$_POST['sid'];
//echo $_sid;
$_product_id=$_POST['product_id'];
//echo $_product_id;
$_product_title=$_POST['product_title'];
//echo $_product_title;

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
//echo $_qty;
$_unite_price=$_POST['unite_price'];
$_total_price= ($_unite_price* $_qty);

$filename='IMG_'.time().'_'.$_FILES['picture']['name'];
$target= $_FILES['picture']['tmp_name'];
$destination=$approot."uploads/".$filename;
$is_file_moved= move_uploaded_file($target,$destination);

if($is_file_moved){
    $_picture=$filename;
}else{
    $_picture= null;
}


//Connect to Database using PDO
$username = "root";
$password = "";
$conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query= "INSERT INTO `carts` ( `sid`, 
                                `product_id`, 
                                `product_title`,
                                `is_deleted`,
                                 `qty`,
                                 `unite_price`,
                                 `total_price`,
                                 `picture`)
                          VALUES ( :sid,
                           :product_id, 
                           :product_title,
                           :is_deleted,
                            :qty, 
                            :unite_price,
                             :total_price,
                             :picture)";

$stmt=$conn->prepare($query);
$stmt->bindParam(':sid',$_sid);
$stmt->bindParam(':product_id', $_product_id);
$stmt->bindParam(':product_title', $_product_title);
$stmt->bindParam(':is_deleted', $_is_deleted);
$stmt->bindParam(':qty', $_qty);
$stmt->bindParam(':unite_price', $_unite_price);
$stmt->bindParam(':total_price', $_total_price);
$stmt->bindParam(':picture', $_picture);

$result=$stmt->execute();

if($result){
    $_SESSION['message'] = "Cart is added successfully";
}else{
    $_SESSION['message'] = "Cart is not added successfully";
}
header("location:index.php");
?>


