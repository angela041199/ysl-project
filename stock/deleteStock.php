<?php
require_once("../includes/connect_sever.php");
$id=$_POST["id"];

$sql="UPDATE stock SET valid = 0 WHERE id=$id ";

if ($conn->query($sql) === TRUE ){
    echo "更新成功";
}else {
    echo "更新資料錯誤:" .
    $conn->error;
}

$conn->close();
// header("location:order.php");

?>

?>