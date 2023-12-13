<?php
session_start();
include("include.php");
/* include("../style/sellerDashboard_sideNav.php"); */
/* include("../style/ysl-nav.php"); */
require_once("../includes/connect_sever.php");

//$seller_id = 2; 測試
$seller_id = $_SESSION['seller_id'];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
    $updateQuery = "UPDATE product SET exist_valid = 0 WHERE id = $product_id";
    $updateResult = $conn->query($updateQuery);

    if ($updateResult === TRUE) {
        echo '<script>alert("商品已刪除！返回編輯模式");</script>';
        echo '<script>window.location.href = "edit_product.php";</script>';
    } else {
        echo "錯誤: " . $conn->error;
    }
}

$conn->close();
?>
