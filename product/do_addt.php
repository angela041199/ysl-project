<?php
session_start();
include("include.php");
/* include("../style/sellerDashboard_sideNav.php"); */
/* include("../style/ysl-nav.php"); */
require_once("../includes/connect_sever.php");

$seller_id = 2; //測試
/* $seller_id = $_SESSION['seller_id']; */


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $valid = 1;
    $name = $_POST['name'];
    $insertQuery = "INSERT INTO type (name, valid) VALUES ('$name', '$valid')";

    if ($conn->query($insertQuery) === TRUE) {
        echo '<script>alert("類別新增成功！");</script>';
        echo '<script>window.location.href = "type.php";</script>';
    } else {
        echo "錯誤：" . $conn->error;
    }

    $conn->close();
}
?>
