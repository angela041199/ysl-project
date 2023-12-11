<?php 

require_once('../db_connect.php');

if(!isset($_POST["id"])){
    $data=[
        "status"=>0,
        "message"=>"請循正常管道進入"
    ];
    echo json_encode($data);
    exit;
}

$id=$_POST["id"];

// $data=[
//     "id"=>$id
// ];
// echo json_encode($data);

$sql="SELECT * FROM `ysl admin` WHERE id=$id AND valid=1 ORDER BY id ASC";
$result=$conn->query($sql);
$rows=$result->fetch_all(MYSQLI_ASSOC);

if($result->num_rows>0){
    $data=[
        'status'=>1,
        'data'=>$rows
    ];
}else{
    $data=[
        'status'=>0,
        'message'=>"無此使用者"
    ];
}



echo json_encode($data);


$conn->close();

?>