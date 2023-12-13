<?php
require_once("../ysl_project/ysldb-connect.php");

if(!isset($_POST["title"])){
    echo "請循正常管道進入";
    die;
}

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
$time=date('Y-m-d H:i:s');

if(empty($title) || empty($couponCode) || empty($discountType) || empty($discountValue) || empty($usageTimes) || empty($startDate) || empty($expirationDate) || empty($priceRule) || empty($applicableScope)){
    echo "請確認每個欄位資訊需填寫完整";
    exit;
}

// echo "優惠券名稱：".$title."<br>", "優惠券代碼：".$couponCode."<br>", "優惠券狀態：".$status."<br>", "優惠券類型：".$discountType."<br>", "優惠券名稱：".$discountValue."<br>", "優惠券可使用次數：".$usageTimes."<br>", "優惠券開始日期：".$startDate."<br>", "優惠券截止日期：".$expirationDate."<br>", "優惠券只用規定：需滿".$priceRule."才可使用<br>", "優惠券使用範圍：".$applicableScope."<br>", "優惠券使用類別：".$applicableTypeId."<br>", "優惠券創立時間：".$time;

$sql="SELECT * FROM discount_coupon WHERE title='$title' OR coupon_code='$couponCode'";
$result=$conn->query($sql);
$rowCount=$result->num_rows;
//echo $rowCount;
if($rowCount>0){
    die("此優惠券已經存在");
}

$sql="INSERT INTO discount_coupon (title, coupon_code, discount_type, discount_value, usage_times, start_date, expiration_date, price_rule, applicable_scope, applicable_type_id, created_at, status, valid)
VALUES ('$title', '$couponCode', '$discountType', '$discountValue', '$usageTimes', '$startDate', '$expirationDate', '$priceRule', '$applicableScope', '$applicableTypeId','$time', '$status', 1)";

//echo $sql;
//exit;

if ($conn->query($sql) === TRUE) {
    echo "新增資料完成, ";
    $last_id = $conn->insert_id;
    echo "最新一筆為序號".$last_id;
} else {
    echo "新增資料錯誤: " . $conn->error;
}

$conn->close();

header("location: coupon-list.php");

?>