<?php
define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DBNAME", "demoapplogin");

try{
    $connection= new PDO("mysql:host=" . HOST . ";DBNAME=" . "demoapplogin" . ";charset=utf8", USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "success";
} catch (PDOException $e) {
    $e->getMessage();
}