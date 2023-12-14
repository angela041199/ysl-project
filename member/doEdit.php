<?php

require_once("../includes/connect_sever.php");


// if(!isset($_POST["name"])){
//     echo "請循正常管道進入此頁";
//     exit;
// }


$id=$_POST["id"];
$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$birthday=$_POST["birthday"];
$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
$address=$_POST["address"];

// echo "$id", "$email", "$phone", "$birthday", "$gender", "$address"; 

$sql="UPDATE ysl_member SET name='$name', email='$email', phone='$phone', birthday='$birthday', gender='$gender', address='$address' WHERE id=$id";

if ($conn->query($sql) == true){
    echo "$name 資料更新成功";

}else{
    echo "$name 更新失敗";
}


header("location:memberProfile.php?id=" . $row['id']);



$conn->close();


