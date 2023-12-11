<?php

require_once("../comm/dbo_connect.php");

if(isset($_GET['search'])){
$search = $_GET['search'];


$sql="SELECT * FROM article WHERE article.title LIKE '%$search%' AND valid=1";
$result = $conn->query($sql);
$rows=$result->fetch_all(MYSQLI_ASSOC);
}

if($result->num_rows > 0){
    $data=[
        "status"=>1,
        "data"=>$rows
    ];
}else{
    $data=[
        "status"=>0,
        "message"=>"查詢不到結果"
    ];
}

echo json_encode($data);

$conn->close();


?>