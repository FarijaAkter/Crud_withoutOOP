<?php

$webroot="http://localhost/crud/";
//$_id=1;
$_id=$_GET['id'];
//var_dump($_GET);
$username = "root";
$password = "";

$conn = new PDO("mysql:host=localhost;dbname=ecommerce", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "Connected successfully";

$query="SELECT * FROM `banners`  WHERE id=:id";
//$query="SELECT * FROM `banners` WHERE id=1";
$stmt=$conn->prepare($query);
$stmt->bindParam(':id',$_id);

$result=$stmt->execute();
$banner=$stmt->fetch();
/*echo"<pre>";
print_r($banner);
echo"</pre>";*/


?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Show</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <h1 class="text-center">Show</h1>
            <dl class="row">
                <dt class="col-md-3">ID :</dt>
                <dd class="col-md-9"><?=$banner['id'];?></dd>
            </dl>
            <dl class="row">
                <dt class="col-md-3">Is_active:</dt>
                <dd class="col-md-9"><?=$banner['is_active']? 'Active': 'Deactive';?></dd>
            </dl>
            <dl class="row">
                <dt class="col-md-3">Is_active:</dt>
                <dd class="col-md-9"><?=$banner['is_deleted']? 'Deleted': 'Not Deleted';?></dd>
            </dl>
            <dl class="row">
                <dt class="col-md-3">Created_At:</dt>
                <dd class="col-md-9"><?=$banner['created_at'];?></dd>
            </dl>
            <dl class="row">
                <dt class="col-md-3">Modified_At:</dt>
                <dd class="col-md-9"><?=$banner['modified_at'];?></dd>
            </dl>
            <dl class="row">
                <dt class="col-md-3">Picture:</dt>
                <dd class="col-md-9">
                    <?=$banner['picture'];?>
                    <img src="<?=$webroot;?>uploads/<?=$banner['picture'];?>">
                </dd>
            </dl>
            <dl class="row">

                <dd class="col-md-9">
                    Go to  <a href="index.php">List</a>
                </dd>
            </dl>
        </div>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>

