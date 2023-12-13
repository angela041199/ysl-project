<?php
session_start();
include("include.php");
/* include("../style/sellerDashboard_sideNav.php"); */
/* include("../style/ysl-nav.php"); */
require_once("../includes/connect_sever.php");

$seller_id = 2; //測試
/* $seller_id = $_SESSION['seller_id']; */


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['type_id'])) {
    $type_id = intval($_GET['type_id']);
    $updateQuery = "UPDATE type SET valid = 0 WHERE id = $type_id";
    $updateResult = $conn->query($updateQuery);

    if ($updateResult === TRUE) {
        echo '<script>alert("類別已刪除！");</script>';
        echo '<script>window.location.href = "type.php";</script>';
    } else {
        echo "錯誤: " . $conn->error;
    }
}

$conn->close();
?>
