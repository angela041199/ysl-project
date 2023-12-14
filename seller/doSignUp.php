<?php
require_once("../includes/connect_sever.php");
session_start();

if(!isset($_POST["shop_name"])){
    echo "請循正常管道進入";
    exit;
}

// if(!isset($_POST["name"])){
//     $data=[
//         "status"=>0,
//         "message"=>"請循正常管道進入"
//     ];
//     echo json_encode($data);
//     exit;
// }

$shop_name=$_POST["shop_name"];
// $email=$_POST["email"];
$sub_email=$_POST["sub_email"];
$shop_created_at=date('Y-m-d H:i:s');

$_SESSION['shop_name'] = $shop_name;

if(empty($sub_email) && empty($shop_name)){
    $msg="請填入完整資訊";
    $_SESSION["msg"]=$msg;
    header("location: signup.php");
    exit;
}

if(empty($sub_email)){
    $msg="請填入信箱";
    $_SESSION["msg"]=$msg;
    header("location: signup.php"); 
    exit;
}

if(empty($shop_name)){
    $msg="請填入店名";
    $_SESSION["msg"]=$msg;
    header("location: signup.php");
    exit;
}

// 檢查店名是否已有人使用
$sql = "SELECT * FROM ysl_seller WHERE shop_name ='$shop_name'";
$result = $conn->query($sql);
$rowCount=$result->num_rows;
if($rowCount>0){
    $msg="此店名已有人使用";
    $_SESSION["msg"]=$msg;
    header("location: signup.php");
    exit;
}


// 存入會員資料
$sql = "INSERT INTO ysl_seller (shop_name, sub_email, shop_created_at, seller_valid)
	VALUES ('$shop_name', '$sub_email', '$shop_created_at', 1)";


if($conn->query($sql)===true){
    $row=$result->fetch_assoc();
    $_SESSION["seller"]=$row;
    // echo "會員資料新增成功<br>";
    $last_id=$conn->insert_id;
    // echo "最近新增的資料序號為：".$last_id;
    $_SESSION["seller_id"]=$last_id;
    
    $memberAccount=$_SESSION['member']['account'];
    $membersql = "UPDATE ysl_member SET member_identity=$last_id WHERE account='$memberAccount'";
    $conn->query($membersql);
    header("location:./seller_dashboard.php?id=$last_id");

}else{
    echo "會員資料新增失敗".$conn->error;
}


// $seller_id=$_SESSION['seller_id'];
// UPDATE users SET phone='0911111111' WHERE id=3
// $sql="UPDATE ysl_member SET member_identity = $member_id WHERE ="
// $row=$result->fetch_assoc();
// $_SESSION["ysl_seller"]=$row;


// 變成商家後更改會員id
// $sql = "SELECT ysl_member.*, ysl_seller.* FROM ysl_member JOIN ysl_seller ON ysl_member.member_identity = ysl_seller.seller_id";
// $sql = "SELECT * FROM ysl_seller WHERE seller_id='$seller_id' AND valid=1";

// $shopresult = $conn->query($sql);
// $row=$shopresult->fetch_assoc();
// $_SESSION["ysl_seller"]=$row;


$conn->close();
?>