<?php
session_start();
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
<?php
//Nap ket noi den CSDL
include_once "config.php";

$errors = array();

if(isset($_POST) && !empty($_POST) ){
    if(!isset($_POST["username"]) || empty($_POST["username"])){
        $errors[] = "Username khong hop le";
    }

    if(!isset($_POST["password"]) || empty($_POST["password"])){
        $errors[] = "Password khong hop le";
    }

    if(!isset($_POST["confirm_password"]) || empty($_POST["confirm_password"])){
        $errors[] = "Confirm Password khong hop le";
    }

    if($_POST["confirm_password"] != $_POST["password"]){
        $errors[] = "Confirm password khac password";
    }

    if(empty($errors)){
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $created_at = date("Y-m-d H:i:s");

        $qInsert = "INSERT INTO demoapplogin.users (username, password, created_at) VALUES (:username,:password,:created_at)";
        $stmt = $connection->prepare($qInsert);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":created_at", $created_at);
        $stmt->execute();
        echo "<div class='alert alert-success'>";
        echo "Dang ky thanh cong. Hay " . "<a href='login.php' >dang nhap</a>" . "thoi nao!";
        echo "</div>";

    } else {
        $errors_string = implode("<br>", $errors);
        echo "<div class='alert alert-danger'>";
        echo $errors_string;
        echo "</div>";
    }

}

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form name="login" action="" method="post">
                <div class="form-group" style="margin-top: 150px;">
                    <h1>Đăng ký người dùng</h1>
                    <label>User name</label>
                    <input type="text"  name="username" class="form-control" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password"  name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password"  name="confirm_password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
