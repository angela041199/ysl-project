<?php
require_once("../includes/connect_sever.php");

session_start();
if(!isset($_POST["account"])){
    $msg="請循正常管道進入此頁";
    $_SESSION["msg"]=$msg;
    exit;
}

$account=$_POST["account"];
$password=$_POST["password"];

if(empty($account)){
    $msg="請輸入帳號";
    $_SESSION["msg"]=$msg;
    header("location: signin.php");
    exit;
}
if(empty($password)){
    $msg="請輸入密碼";
    $_SESSION["msg"]=$msg;
    header("location: signin.php");
    exit;
}

$password=md5($password);
$sql="SELECT * FROM ysl_member WHERE account='$account' AND password = '$password' AND valid=1";
$result = $conn->query($sql);
// var_dump($result);

if($result->num_rows==0){
    // if(isset($_SESSION["error"]["times"])){
    //     $_SESSION["error"]["times"]++;
    // }else{
    //     $_SESSION["error"]["times"]=1;
    // }
    $msg="帳號或密碼錯誤";
    $_SESSION["msg"]=$msg;
    header("location: signin.php");
    exit;
}else{
    // echo "登入成功";
    $row=$result->fetch_assoc();
    // var_dump($row);
    $_SESSION["member"]=$row;

    if($_SESSION["member"]["member_identity"]>0){
        header("location: seller_dashboard.php");
        $_SESSION["shop_name"]=$shop_name;
        $_SESSION["seller_id"]=$_SESSION['member']['member_identity'];
    }else{
    header("location: ysl_index.php");
}}


$rowCount=$result->num_rows;
if($rowCount<0){
    $msg="此帳號不存在";
    $_SESSION["msg"]=$msg;
    header("location: signup.php");
    exit;
}


// header("location:signup.php");
$conn->close();
?>
<pre>
    <?php
    // print_r($result);
    ?>
</pre>