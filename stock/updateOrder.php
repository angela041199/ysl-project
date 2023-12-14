<?php
require_once("../includes/connect_sever.php");
$status=$_POST["status"];
$id=$_POST["id"];

$sql="UPDATE orders SET status = '$status' WHERE id=$id";
// var_dump($sql);


if ($conn->query($sql) === TRUE ){
    echo "更新成功";
}else {
    echo "更新資料錯誤:" .
    $conn->error;
}

$conn->close();
header("location:order.php");

?>