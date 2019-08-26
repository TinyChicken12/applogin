<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    header("Location: index.php");
    exit;
}

//Nap ket noi den CSDL
include_once "config.php";

$errors = array();
$flag = "";

if(isset($_POST) && !empty($_POST) ) {

    if (!isset($_POST["username"]) || empty($_POST["username"])) {
        $errors[] = "Username khong hop le";
    }

    if (!isset($_POST["password"]) || empty($_POST["password"])) {
        $errors[] = "Password khong hop le";
    }

    if(empty($errors)){
        $username = $_POST["username"];
        $password = md5($_POST["password"]);

        //Lay du lieu tu CSDL de doi chieu
        $qSelect = "SELECT * FROM  demoapplogin.users WHERE username = :username AND password =:password";
        //echo $qSelect;
        $stmt = $connection->prepare($qSelect);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
        //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<pre>";
        print_r($row);
        echo "</pre>";

        //if(isset($row) && !empty($row)){
        if (isset($row["id"]) && !empty($row["id"] > 0)) { //Tức có người dùng đúng với thông tin gõ
            //$flag = false;
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $row["username"];

            header("Location: index.php");
            //$flag = false;  //Gán khi cả 2 thông tin đều nhập đúng
        } else{
            $flag = true;
        }
    } else {
        $errors_string = implode("<br>", $errors);
        echo "<div class='alert alert-danger'>";
        echo $errors_string;
        echo "</div>";
    }

    var_dump($flag);
    if($flag){
        echo "<div class='alert alert-danger'>";
        echo "Kiem tra lai username, password!";
        echo "</div>";
    }
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
            <form name="register" action="" method="post">
                <div class="form-group" style="margin-top: 150px;">
                    <h1>Đăng nhập</h1>
                    <label>User name</label>
                    <input type="text" class="form-control" name="username"  placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control"  name="password" placeholder="Password">
                </div>
                <div class="form-check">
                    <p><a href="register.php">Đăng ký</a></p>
                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
