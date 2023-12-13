<?php
require("../do/ysl_connect.php");

// if(!isset($_POST["$quantity"])){
//     echo "請依正常管道進入";
//     exit;
// }

$quantity=$_POST["quantity"];
$id=$_POST["id"];

$sql="UPDATE stock SET quantity = '$quantity' WHERE id=$id";


if ($conn->query($sql) === TRUE ){
    echo "更新成功";
}else {
    echo "更新資料錯誤:" .
    $conn->error;
}

$conn->close();
header("location:stock.php");

?>
