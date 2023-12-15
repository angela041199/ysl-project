<?php

require_once("../includes/connect_sever.php");
session_start();

$name=$_POST["name"];
$account=$_POST["account"];
$password=$_POST["password"];
$repassword=$_POST["repassword"];
// $phone=$_POST["phone"];
$email=$_POST["email"];
// $birthday=$_POST["birthday"];
// $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";

// echo "$name<br>$account<br>$password<br>$repassword<br>$email<br>";

$_SESSION["name_buyer"]=$_POST['name']; 
$_SESSION["account_buyer"]=$_POST['account'];
$_SESSION["email_buyer"]=$_POST['email'];


if(empty($name)|| empty($account) ||  empty($repassword) 
|| empty($email)){
    $message = "請輸入必填欄位";
    $_SESSION["error"]["message_member"]= $message;
    header("location:memberSignup.php");
    exit;
}


if($password != $repassword){
    $message = "前後密碼不一致";
    $_SESSION["error"]["message_member"]= $message;
    header("location:memberSignup.php");
    exit;

}

$sql="SELECT * FROM ysl_member WHERE account='$account'";
$result=$conn->query($sql);
$accountRow=$result->num_rows;

if($accountRow>0){
    $message = "此帳號已存在";
    $_SESSION["error"]["message_member"]= $message;
    header("location:memberSignup.php");
    exit;
}

$sql="SELECT * FROM ysl_member WHERE email='$email'";

$result=$conn->query($sql);
$emailRow=$result->num_rows;

if($emailRow>0){
    $message = "此信箱已註冊";
    $_SESSION["error"]["message_member"]= $message;
    header("location:memberSignup.php");
    exit;
}


$password = md5($password);

$time=date('Y-m-d H:i:s');

$dateTime = new DateTime($birthday);
$birthdayMonth = $dateTime->format('m'); 
// 'm' returns the month as a two-digit number (01 to 12)


$sql="INSERT INTO ysl_member (name, account, password, email, created_at, birthday_month)
VALUES('$name', '$account', '$password', '$email', '$time', '$birthdayMonth')";

// echo $sql;

$result = $conn->query($sql);

if ($result !== false) {
    $_SESSION['success_message'] = $id . ' ' . $name . ' 歡迎加入YSL！';
    header("location: memberSignup.php");
    exit;
} else {
    $_SESSION['error_message'] = '加入失敗';
    header("location: memberSignup.php");
    exit;
}


// if ($conn->query($sql) === TRUE) {
//     echo "新增資料完成,";
//     $last_id = $conn->insert_id;
//     echo "最新一筆為序號" .$last_id;
// } else {
//     echo "新增資料錯誤: " . $conn->error;
// }

$conn->close();

// header("location: memberProfile.php");



?>