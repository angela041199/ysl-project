<?php

require_once("../connect_server.php");

$id=$_POST["id"];
$name=$_POST["name"];

$sql="UPDATE ysl_member SET valid=1 WHERE id=$id";
$result=$conn->query($sql);

if($result !==false){
    echo "恢復 id:' . $id . ' ' . $name . ' 使用者成功";
    header("location:./member-deleted-list.php");
}else{
    echo "恢復 id:' . $id . ' ' . $name . ' 使用者失敗";

}

$conn->close();

?>
