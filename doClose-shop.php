<?php
require_once("./db_connect.php");
session_start();

$seller_id = $_SESSION['seller_id'];
$close_reason=$_POST["close_reason"];

// 軟刪除關店
$sql = "UPDATE ysl_seller SET valid=0 , close_reason='$close_reason' WHERE seller_id='$seller_id'";


// if ($conn->query($sql) === TRUE) {
//     	echo "新資料輸入成功";
// } else {
//     	echo "Error: " . $sql . "<br>" . $conn->error;
// }


header("location: signup.php");
?>