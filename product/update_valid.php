<?php
session_start();
include("include.php");
/* include("../style/sellerDashboard_sideNav.php"); */
/* include("../style/ysl-nav.php"); */
require_once("../includes/connect_sever.php");

/* $seller_id = 2; */ //測試
$seller_id = $_SESSION['seller_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $new_valid = $_POST['new_valid'];

    // 更新資料庫中的 valid 欄位
    $updateQuery = "UPDATE product SET valid = $new_valid WHERE id = $product_id";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Success";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request method";
}
?>
