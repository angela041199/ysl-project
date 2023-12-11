<?php

require_once("../comm/connect_sever.php");

//'php://input' 是一個讀取原始POST數據的I/O流。它允許您訪問非表單數據的原始POST數據（例如JSON或XML格式的數據）。在這種情況下，它用於獲取由JavaScript（例如Ajax請求）發送的原始JSON數據。
//true 指示 json_decode 函數將JSON對象轉換為PHP關聯陣列

//假設接收的是json格式
$input = json_decode(file_get_contents('php://input'), true);

//var_dump($input);

if(isset($input['articleIDs']) && is_array($input['articleIDs'])){

    $errOccurred = false;

    // 執行刪除操作
    foreach($input['articleIDs'] as $id) {
        $sql = "UPDATE article SET valid='0' WHERE id=$id";
        //如果有一個刪除失敗的話
        if($conn->query($sql) === false){
            $errOccurred = true;
            break;
        }
    }

    if($errOccurred){
        $data=[
            "status"=>0,
            "message"=>"無文章可以刪除!"
        ];
    }else{
        $data=[
            "status"=>1,
            "message"=>"成功刪除文章!"
        ];
    }

    echo json_encode($data);
    exit;
}

$conn->close();

?>