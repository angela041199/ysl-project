<?php
session_start();
include("include.php");
/* include("../style/sellerDashboard_sideNav.php"); */
/* include("../style/ysl-nav.php"); */
require_once("../includes/connect_sever.php");

/* $seller_id = 2; */ //測試
$seller_id = $_SESSION['seller_id'];



// 檢查是否有提交的 type_id 和 name
if (isset($_POST['type_id'], $_POST['name'])) {
    $type_id = $_POST['type_id'];
    $name = $_POST['name'];

    $sql = "UPDATE type SET name = '$name' WHERE id = '$type_id'";
    $updateResult = $conn->query($sql);

    // 檢查更新是否成功
    if ($updateResult === TRUE) {
        echo '<script>alert("類別更新成功！");</script>';
        /* echo '<script>window.location.href = "type.php";</script>'; */
    } else {
        echo "更新資料錯誤: " . $conn->error;
    }
} else {
    echo "未提交必要的數據";
}


// 關閉數據庫連接
$conn->close();
?>
