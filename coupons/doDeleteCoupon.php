<?php
require_once("../ysl_project/ysldb-connect.php");

if(!isset($_GET["coupon_id"])){
    echo "請循正常管道進入此頁";
    exit;
}

$id=$_GET["coupon_id"];

$sql="UPDATE discount_coupon SET valid='0' WHERE coupon_id=$id";

//echo $sql;

if($conn->query($sql) === TRUE){
    echo "刪除成功！";
}else{
    echo "刪除失敗：".$conn->error;
}

$conn->close();

header("location:coupon-list.php");

?>