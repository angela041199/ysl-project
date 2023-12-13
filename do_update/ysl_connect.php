<?php
$severname = "localhost";
$username = "admin";
$password = "12345";
$dbname = "ysl";

//Create connection
$conn = new mysqli($severname,$username,$password,$dbname);
//檢查連線
if ($conn->connect_error){
    die("連線失敗:".$conn->connect_error);
}else{
    // echo "資料連線成功";
}
