<?php
$servername = "localhost";
$username = "admin";
$password = "12345";
$dbname = "ysl_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("連線失敗:".$conn->connect_error);
}

?>