<?php
session_start();

//Neu nguoi dung chua login tuc chua co session login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
    //chuyen huong sang login.php
    header("Location: login.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Đăng nhập thành công</h1>
            <p>Tên người dùng: <?php echo $_SESSION["username"] ?> </p>
            <p><a href="logout.php">Đăng xuất</a></p>
        </div>
    </div>
</div>
</body>
</html>
<?php
