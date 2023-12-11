<?php

require_once("../db_connect.php");
session_start();


if(!isset($_POST["username"]) && !isset($_POST["password"])){
    echo "請循正常管道進入此頁面";
    exit;
}

$username=$_POST["username"];
$password=$_POST["password"];

// echo $username, $password;

// var_dump($_POST);

if(empty($username)){
    $message="請輸入帳號";
    $_SESSION["error"]["message"]=$message;
    header("location:admin-login.php");
    exit;
}

if(empty($password)){
    $message="請輸入密碼";
    $_SESSION["error"]["message"]=$message;
    header("location:admin-login.php");
    exit;
}

$password=password_hash($password, PASSWORD_DEFAULT);

// echo $username, $password;

$sql="SELECT * FROM ysl_admin WHERE username='$username' AND password='$password' AND valid=1";

$result=$conn->query($sql);


if($result->num_rows==0){
    $message="帳號或密碼錯誤";
    $_SESSION["error"]["message"]=$message;
    header("location:admin-login.php");
    exit;

}else{

echo "登入成功";}

$conn->close();

?>

