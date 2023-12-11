<?php

require_once("../db_connect.php");

// if(isset($_POST["account"]) || ($_POST["password"])){
//     echo "請循正常管道進入";
// }

$name=$_POST["name"];
$account=$_POST["account"];
$password=$_POST["password"];
$repassword=$_POST["repassword"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$birthday=$_POST["birthday"];
$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";

// echo "$name<br>$account<br>$password<br>$repassword<br>$phone<br>$email<br>$gender<br>$birthday";

if(empty($name)|| empty($account) || empty($password) || empty($repassword) 
|| empty($phone) || empty($email) || empty($birthday)  || empty($gender)){
    echo "請輸入必填欄位";
    exit;
}


if($password != $repassword){
    echo "前後密碼不一致";
    exit;
}

$sql="SELECT * FROM ysl_member WHERE account='$account'";
$result=$conn->query($sql);
$accountRow=$result->num_rows;

if($accountRow>0){
    die("此帳號已經存在");
}

$sql="SELECT * FROM ysl_member WHERE email='$email'";

$result=$conn->query($sql);
$emailRow=$result->num_rows;

if($emailRow>0){
    die("此信箱已經存在");
}


$password = md5($password);

$time=date('Y-m-d H:i:s');

$dateTime = new DateTime($birthday);
$birthdayMonth = $dateTime->format('m'); 
// 'm' returns the month as a two-digit number (01 to 12)


$sql="INSERT INTO ysl_member (name, account, password, phone, email, birthday, gender, created_at, birthday_month)
VALUES('$name', '$account', '$password', '$phone', '$email', '$birthday', '$gender', '$time', '$birthdayMonth')";

// echo $sql;

$result = $conn->query($sql);

if ($result !== false) {
    echo "新增會員資料成功";
    $last_id = $conn->insert_id;
    echo "最新一筆為序號" .$last_id;
} else {
    echo "新增會員資料失敗" . $sql . "<br>" . $conn->error;
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