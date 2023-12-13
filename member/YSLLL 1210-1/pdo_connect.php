<?php

$servername= "localhost";
$username="admin";
$password="123456";
$dbname="mydb";;


try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // echo "資料庫連線成功";
}catch(PDOException $e){
    echo "資料庫連線失敗: " . $e->getMessage();
}