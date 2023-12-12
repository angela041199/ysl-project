<?php

require_once("./comm/connect_sever.php");

$title = $_POST['title'];
$category = $_POST['category_id'];
$tags = isset($_POST['tags']) ? explode(",", $_POST['tags']) : array();
$editorContent = $_POST['editorContent'];
$authorName=$_POST['author'];
$image=$_FILES['image']['name']; 
date_default_timezone_set('Asia/Taipei');
$createTime = date('Y-m-d H:i:s');

// echo $title,$category,$authorName;
// echo "<br>";
// echo $editorContent;
// echo "<br>";
// var_dump($image);
// echo "<br>";
// var_dump($tags);
// echo "<br>";
// echo $createTime;



// 檢查作者是否存在於 article_author 表
$sqlCheckAuthor = "SELECT id FROM article_author WHERE name = '$authorName'";
$resultCheckAuthor = $conn->query($sqlCheckAuthor);
$authorId = null;

if ($resultCheckAuthor->num_rows > 0) {
    // 作者存在，獲取ID
    $row = $resultCheckAuthor->fetch_assoc();
    $authorId = $row['id'];
} else {
    // 作者不存在，插入新作者
    $sqlInsertAuthor = "INSERT INTO article_author (name) VALUES ('$authorName')";
    if ($conn->query($sqlInsertAuthor) === TRUE) {
        $authorId = $conn->insert_id;
    } else {
        echo "新增作者錯誤: " . $conn->error;
        exit;
    }
}


// 指定圖片存儲路徑
$uploadDir = './images/upload/';
$uploadFile = $uploadDir . $image;


//getimagesize() 函數將測定任何GIF，JPG，PNG... 影像檔案的大小並傳回影像的尺寸以及檔案類型及圖片高度與寬度
//先檢查是否有圖片上傳
if(empty($_FILES['image']['tmp_name'])){
    echo "請上傳文章預覽圖片";
    exit;
}else{
    // 檢查是否為圖片
    if (getimagesize($_FILES['image']['tmp_name']) === false) {
    echo "<script>alert('檔案格式不正確，請重新上傳'); window.location.href='create-article.php';</script>";
    exit;
}
}


// 檢查文件是否已經存在
if (file_exists($uploadFile)) {
    echo "<script>alert('圖片檔名重複，上傳失敗!'); window.location.href='create-article.php';</script>";
    exit;
}

// 檢查文件大小（例如不超過5MB）
if ($_FILES['image']['size'] > 5000000) {
    echo "<script>alert('對不起，您的檔案太大!'); window.location.href='create-article.php';</script>";
    exit;
}

// 嘗試上傳文件
if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
    // 文件上傳成功，現在插入數據庫
    $sqlInsertImg = "INSERT INTO article_img (URL_name) VALUES ('$image')";
    if ($conn->query($sqlInsertImg) === true) {
        $imgId = $conn->insert_id;
        
    } else {
        echo "圖片資料庫插入錯誤: " . $conn->error;
        exit;
    }
} else {
    echo "對不起，上傳文件錯誤。";
    exit;
}

//依據按鈕新增文章狀態
$statusId=0;
if(isset($_POST['action']) && $_POST['action'] == 'publish'){
    $statusId = 1; // 設置為已發佈狀態
}elseif(isset($_POST['action']) && $_POST['action'] == 'unpublish'){
    $statusId = 2 ; //設置為未發佈狀態
}



$sqlInsert = "INSERT INTO article (title,category_id,content,author_id,img_id, status_id, created_time,valid) VALUES ('$title','$category','$editorContent','$authorId','$imgId', '$statusId','$createTime',1)";

if($conn->query($sqlInsert) === true){
    $lastID=$conn->insert_id;
    echo "<script>alert('新增文章成功'); window.location.href='article-list.php';</script>";
}else{
    echo "<script>alert('新增文章失敗，請重新嘗試'); window.location.href='create-article.php';</script>";
}

foreach ($tags as $tag) {
    // 檢查標籤是否存在
    $sqlCheckTag = "SELECT id FROM tags_list WHERE name = '$tag'";
    $resultCheckTag = $conn->query($sqlCheckTag);
    $tagId = null;

    if ($resultCheckTag->num_rows > 0) {
        // 標籤存在
        $row = $resultCheckTag->fetch_assoc();
        $tagId = $row['id'];
    } else {
        // 標籤不存在，插入新標籤
        $sqlInsertTag = "INSERT INTO tags_list (name) VALUES ('$tag')";
        if ($conn->query($sqlInsertTag) === TRUE) {
            $tagId = $conn->insert_id;
        } else {
            echo "新增標籤錯誤: " . $conn->error;
            exit;
        }
    }

    // 更新 article_tags 表
    $sqlInsertArticleTag = "INSERT INTO article_tags (article_id, tag_id) VALUES ('$lastID', '$tagId')";
    if (!$conn->query($sqlInsertArticleTag)) {
        echo "更新標籤錯誤: " . $conn->error;
        exit;
    }
}



?>