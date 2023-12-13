<?php
require_once("../ysl_project/ysldb-connect.php");

if(!isset($_POST["title"])){
    echo "請循正常管道進入此頁";
    exit;
}

$id=$_POST["coupon_id"];
$title=$_POST["title"];
$couponCode=$_POST["coupon_code"];
$status=$_POST["status"];
$discountType=$_POST["discount_type"];
$discountValue=$_POST["discount_value"];
$usageTimes=$_POST["usage_times"];
$startDate=$_POST["start_date"];
$expirationDate=$_POST["expiration_date"];
$priceRule=$_POST["price_rule"];
$applicableScope=$_POST["applicable_scope"];
$applicableTypeId=$_POST["applicable_type_id"];

$sql="UPDATE discount_coupon SET title='$title', status='$status', discount_type='$discountType', discount_value='$discountValue', usage_times='$usageTimes', start_date='$startDate', expiration_date='$expirationDate', price_rule='$priceRule', applicable_scope='$applicableScope', applicable_type_id='$applicableTypeId' WHERE coupon_id=$id";

//echo $sql;

if ($conn->query($sql) === TRUE){
    echo "資料更新成功！";
}else{
    echo "資料更新失敗：".$conn->error;
}

header("location: coupon.php?coupon_id=$id");

$conn->close();
?>