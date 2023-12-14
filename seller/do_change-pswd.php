<?php
require_once("../includes/connect_sever.php");
session_start();
$msg = $_SESSION["msg"];
  
$account=$_SESSION["member"]["account"];
// echo $account;
$psw=md5($_SESSION["member"]['password']);
// echo $psw;
$sql="SELECT * FROM ysl_member WHERE account ='$account'";
$result = $conn->query($sql);
// var_dump($result);

$password=$_POST["psw"];
$n_psw=$_POST["n_psw"];
$re_n_psw=$_POST["re_n_psw"];

if($psw!=$password){
    $msg="密碼輸入錯誤";
    $_SESSION["msg"]=$msg;
    header("location: change-password.php");
}

if(empty($password)){
    $msg="請輸入原始密碼";
    $_SESSION["msg"]=$msg;
    header("location: change-password.php");
    exit;
}

if($n_psw!=$re_n_psw){
    $msg="新密碼與確認密碼不一致,請確認";
    $_SESSION["msg"]=$msg;
    header("location: change-password.php");
}
$n_psw=md5($n_psw);
$update_psw="UPDATE ysl_member SET password = '$n_psw' WHERE account ='$account'";
if ($conn->query($update_psw) === TRUE) {
    echo "更新成功";
} else {
    header("location: change-password.php");
    exit;
}

// $conn->query($update_psw);
$conn->close();

?>