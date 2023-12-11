<?php

require_once("./comm/connect_sever.php");


$id=$_POST['id'];
$title=$_POST['title'];
$category=$_POST['category_id'];
$tags=isset($_POST['tags']) ? explode(',', $_POST['tags']) : array(); //tags是一個包含所有標籤的數組陣列
$editorContent = $_POST['editorContent'];
$authorName=$_POST['author'];
$image=$_FILES['image']; //檔案傳送


////作者名稱編輯
//1.獲取當前作者名稱
$sqlGetArticle = "SELECT article.*, article_author.id AS author_id, article_author.name AS author_name
FROM article JOIN article_author ON article.author_id = article_author.id WHERE article.id = '$id' AND valid = 1";
$resultArticle = $conn->query($sqlGetArticle);
if($resultArticle->num_rows > 0){
    $articleDetails = $resultArticle->fetch_assoc();
    $currentAuthorId = $articleDetails['author_id'];  //獲取當前author_id
}else{
    echo "文章不存在!";
    exit;
}



//如果更新的作者名稱不等於原作者名稱
if($authorName  != $articleDetails['author_name']){
    $sqlCheckAuthor = "SELECT id FROM article_author WHERE name = '$authorName'";
    $resultCheckAuthor = $conn->query($sqlCheckAuthor);

    if($resultCheckAuthor->num_rows > 0){
        // 如果作者名稱已存在，獲取其 ID
        $authorId = $resultCheckAuthor->fetch_assoc()['id'];
    }else{
        //如果作者名稱不存在，新增作者名稱至article_author並獲取最後新增的id
        $sqlInsertAuthor = "INSERT INTO article_author (name) VALUES ('$authorName')";
        if ($conn->query($sqlInsertAuthor) === true) {
            $authorId = $conn->insert_id;
        } else {
            echo "新增作者名稱失敗 " . $conn->error;
            exit;
        }
    }
}else{
    // 如果作者名未更改，則使用當前作者的ID
    $authorId = $currentAuthorId;
}



//如果有上傳圖片且上傳圖片成功的話
if(isset($_FILES['image']) && $_FILES['image']['error']==0){
    //處理圖片上傳移到upload根目錄
    $targetPath = './images/upload/'.basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'],$targetPath);

    //在外鍵資料表article_img 更新資料
    $img_id=insertOrUpdateImg($targetPath,$conn);

}else{
    //如果沒有圖片上傳,保持原img_id
    $sqlGetOldIMg = "SELECT img_id FROM article WHERE id='$id'";
    $resultGetOldImg = $conn->query($sqlGetOldIMg);
    if($resultGetOldImg && $resultGetOldImg->num_rows > 0){
        //如果有原圖片、且成功取得原圖片img_id
        $row=$resultGetOldImg->fetch_assoc();
        $img_id = $row['img_id'];
    }else{
        echo "取得原圖片id失敗".$conn->error;
        exit;
    }
    
}


$sqlArticle = "UPDATE article 
JOIN article_author ON article.author_id =  article_author.id  
JOIN article_img ON article.img_id =  article_img.id 
JOIN article_category ON article.category_id =  article_category.id 
JOIN article_status ON article.status_id =  article_status.id  
SET title='$title', category_id='$category', content='$editorContent', author_id = '$authorId', img_id='$img_id' 
WHERE article.id='$id' AND valid=1";


if($conn->query($sqlArticle) === true){
    echo "<script>alert('儲存更新成功'); 
    window.location.href='article-list.php';</script>";;
}else{
    echo "Error updating record: " . $conn->error;
}


//刪除原有文章的標籤病更新文章標籤們
$sqlDeleteTags = "DELETE FROM article_tags WHERE article_id='$id'";
$conn->query($sqlDeleteTags);
//將提交的標籤數組一個一個取出來並插入新標籤
foreach($tags as $tag){
    //先檢查標籤名稱是否已經存在
    $sqlCheckTag = "SELECT id FROM tags_list WHERE name='$tag'";
    $resultCheckTag = $conn->query($sqlCheckTag);
    $tagId = null;

    if($resultCheckTag && $resultCheckTag->num_rows > 0) {
        // 如果標籤已存在，獲取其ID
        $row = $resultCheckTag->fetch_assoc();
        $tagId = $row['id'];
    } else {
        // 如果標籤不存在，插入新的標籤到 tags_list 資料表
        $sqlInsertTag = "INSERT INTO tags_list (name) VALUES ('$tag')";
        $conn->query($sqlInsertTag);
        $tagId = $conn->insert_id;
    }

    //將標籤與article資料表關聯並新增新的標籤來更新編輯後的標籤們
    $sqlInsertArticleTag = "INSERT INTO article_tags (article_id, tag_id) VALUES ('$id', '$tagId')";
    $conn->query($sqlInsertArticleTag);
}

//echo '標籤更新成功';


//更新或新增圖片並返回img_id
function insertOrUpdateImg($imgPath,$conn){  //$imgPath: 圖片存儲的路徑 $conn:資料庫連接

    //檢查是否有相同路徑的圖片
    $sqlCheckImg = "SELECT id FROM article_img WHERE URL_name = '$imgPath'";
    $resultCheckImg = $conn->query($sqlCheckImg);

    if($resultCheckImg->num_rows > 0){
        //如果已存在相同路徑的圖片
        $row=$resultCheckImg->fetch_assoc();
        return $row['id'];  //返回已存在相同路徑的圖片的article_img.id
    }else{
        //如果圖片路徑不存在，新增圖片路徑名稱至外鍵
        $sqlInsertImg = "INSERT INTO article_img (URL_name) VALUES ('$imgPath')";

        if($conn->query($sqlInsertImg) === true){
            return $conn->insert_id;  //返回新插入的article_img.id
        }else{
            echo "圖片新增上傳失敗".$conn->error;
            return null;
        }
    }

}

?>