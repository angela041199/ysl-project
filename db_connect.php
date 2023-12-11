<?php
$servername= "localhost";
$username="admin";
$password="123456";
$dbname="mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線

if($conn->connect_error){
    die("連線失敗：" .
    $conn->connect_error);
   
}else{
    // echo "資料庫連線成功";
    // 失敗跑回覆即可
}