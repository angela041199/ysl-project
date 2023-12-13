<?php

require_once("../connect_server.php");
session_start();


if (!isset($_POST["username"]) && !isset($_POST["password"])) {
    echo "請循正常管道進入此頁面";
    exit;
}

$username = $_POST["username"];
$password = $_POST["password"];

// echo $username, $password;

// var_dump($_POST);

if (empty($username)) {
    $message = "請輸入帳號";
    $_SESSION["error"]["message"] = $message;
    header("location:admin-login.php");
    exit;
}

if (empty($password)) {
    $message = "請輸入密碼";
    $_SESSION["error"]["message"] = $message;
    header("location:admin-login.php");
    exit;
}

$password = md5($password);

// echo $username, $password;

// $sql = "SELECT * FROM ysl_admin WHERE username='$username' AND password='$password' AND valid=1";

$sql = "SELECT ysl_admin.name, username, password FROM ysl_admin WHERE username='$username' AND password='$password' AND valid=1";



$result = $conn->query($sql);




if ($result->num_rows == 0) {
    // if(isset($_SESSION["error"]["times"])){
    //     $_SESSION["error"]["times"]++;

    // }else{
    //     $_SESSION["error"]["times"]=1;

    // }

    $message = "帳號或密碼錯誤";
    $_SESSION["error"]["message"]= $message;
    header("location: admin-login.php");
    exit;

} else {

        echo "登入成功";
    
}


$row=$result->fetch_assoc();
unset($_SESSION["error"]);
$_SESSION["admin"]=$row;
// var_dump($row);
header("location:index.php");

$conn->close();



?>
