<?php 
require_once("../includes/connect_sever.php");

if(!isset($_POST["id"])){
    echo "請循正常管道進入此頁面";
    exit;
};

$id=$_POST["id"];
$name=$_POST["name"];
// echo $id, $name;


$sql = "UPDATE ysl_member SET valid = 0 WHERE id = $id";
$result = $conn->query($sql);

if ($result !== false) {
    echo '<script> alert("冷凍 id:' . $id . ' ' . $name . ' 使用者成功"); 
    window.location.href = "./member-admin.php";
    </script>';

   
} else {
    echo '<script>alert("冷凍 id:' . $id . ' ' . $name . ' 使用者失敗");
    window.location.href = "./member-admin.php";
    </script>';
}

$conn->close();

//  header("location:./member-admin.php");




// header("location:./member-admin.php");
// '冷凍 id:' . $id $name . ' 使用者成功'
?>