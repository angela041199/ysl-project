<?php

require_once("./comm/connect_sever.php");
include("./style/admin-nav.php");
include("./style/admin_dashboard.php");

$currentPage = isset($_GET['page']) ? $_GET['page']:1;

$perpage = 6;

//計算每一頁從哪一編號開始
$startItem = ($currentPage - 1)*$perpage;

// 計算符合條件的文章總數量
$sqlCount = "SELECT article.*, article_author.name AS author_name, article_img.URL_name, article_category.name AS category_name, article_status.name AS status_name
    FROM  article
    JOIN article_author ON article.author_id =  article_author.id  
    JOIN article_img ON article.img_id =  article_img.id 
    JOIN article_category ON article.category_id =  article_category.id 
    JOIN article_status ON article.status_id =  article_status.id 
    WHERE valid=1";

//分類篩選
$category=isset($_GET['category']) ? intval($_GET['category']) : 0;
    if($category > 0){
        $sqlCount .= " AND article.category_id = $category";
    }

//如果有取得搜尋的值進行模糊搜尋
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sqlCount .=" AND article.title LIKE '%$search%'";
}elseif(isset($_GET['status'])){
        $status = $_GET['status'];

        if($status==""){
            $sqlCount = "SELECT article.*, article_author.name AS author_name, article_img.URL_name, article_category.name AS category_name, article_status.name AS status_name
            FROM  article
            JOIN article_author ON article.author_id =  article_author.id  
            JOIN article_img ON article.img_id =  article_img.id 
            JOIN article_category ON article.category_id =  article_category.id 
            JOIN article_status ON article.status_id =  article_status.id 
            WHERE valid=1 ORDER BY article.id DESC"; 
        }else{
            $sqlCount .= " AND article.status_id = $status";
        }

        
}

$resultCount = $conn->query($sqlCount);
$totalArticle = $resultCount->num_rows;
//需要幾頁
$pageCount = ceil($totalArticle / $perpage);

$sqlCount.= " ORDER BY article.id DESC LIMIT $perpage OFFSET $startItem";
$result= $conn->query($sqlCount);
$rows = $result->fetch_all(MYSQLI_ASSOC);


// 點讚數
$sqlLike = "SELECT article.id, article_like.*, COUNT(article_like.article_id) AS article_count FROM article_like JOIN article ON article_like.article_id = article.id GROUP BY article_like.article_id";
$resultLike = $conn->query($sqlLike);
$rowsLike = $resultLike->fetch_all(MYSQLI_ASSOC);

//文章狀態
$sqlStatus = "SELECT * FROM article_status";
$resultStatus = $conn->query($sqlStatus);
$rowStatus = $resultStatus->fetch_all(MYSQLI_ASSOC);


$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>管理者後台</title>
    <link href="./css/article-table.css?=<?= time(); ?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body class="sb-nav-fixed">

    <div id="layoutSidenav">

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <ol class="breadcrumb mb-4 mt-3">
                        <li class="breadcrumb-item"><a href="index.html">文章管理</a></li>
                        <li class="breadcrumb-item active">文章列表</li>
                    </ol>

                    <section class="header d-flex justify-content-between">
                        <form action="" method="get">
                            <div class="input-search input-group ">
                                <?php if(isset($_GET['search'])): ?>
                                <input type="text" class="form-control get-search" placeholder="<?=$_GET['search']?>"
                                    name="search" id="search">
                                <a class="clear-xmark" href="article-list.php"><i
                                        class="fa-solid fa-circle-xmark"></i></a>
                                <?php else: ?>
                                <input type="text" class="form-control" placeholder="請輸入關鍵字詞" name="search" id="search">
                                <?php endif; ?>
                                <button class="input-group-text send" id="basic-addon2" type="submit"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>

                        </form>

                        <div class="input-right d-flex ">
                            <form action="" method="GET" id="category-form">
                                <select class="form-select" name="category" onchange="this.form.submit()">
                                    <option value="0" <?php if(!isset($_GET['category']) || $category == 0) ?>>依分類篩選
                                    </option>
                                    <option value="1"
                                        <?php if(isset($_GET['category']) && $category == 1) echo 'selected'; ?>>遊戲攻略
                                    </option>
                                    <option value="2"
                                        <?php if(isset($_GET['category']) && $category == 2) echo 'selected'; ?>>發售資訊
                                    </option>
                                    <option value="3"
                                        <?php if(isset($_GET['category']) && $category == 3) echo 'selected'; ?>>遊戲報報
                                    </option>
                                    <option value="4"
                                        <?php if(isset($_GET['category']) && $category == 4) echo 'selected'; ?>>試玩報導
                                    </option>
                                </select>
                            </form>
                            <button class="all-del btn btn-danger" data-bs-target="#confirmationModal">批次刪除</button>
                            <a class="add-post btn btn-primary" href="create-article.php"><i
                                    class="fa-solid fa-plus"></i> 新增文章</a>
                        </div>
                    </section>

                    <!-- Modal -->
                    <div class="modal fade" id="confirmationModal" tabindex="-1"
                        aria-labelledby="confirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-danger fw-bold">您確定要刪除以下文章嗎？</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul id="deleteArticleList" class="mb-3"></ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                    <button type="button" class="btn btn-danger" id="confirmDelete">確認刪除</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <table class="main-table mb-3">
                        <section class="article-status">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link <?php if (!isset($_GET['status']) || $_GET['status']=="") echo "active"; ?>"
                                        aria-current="page"
                                        href="article-list.php?category=<?=isset($_GET['category']) ? intval($_GET['category']) : 0?>">全部</a>
                                </li>
                                <?php foreach ($rowStatus as $status) : ?>
                                <li class="nav-item">
                                    <a class="nav-link 
                                        <?php
                                        if (isset($_GET['status']) && $_GET['status'] == $status['id']) echo "active";
                                        ?>"
                                        href="article-list.php?status=<?= $status['id'] ?>&page=1&category=<?=$category?>"><?= $status['name'] ?></a>
                                </li>
                                <?php endforeach; ?>

                            </ul>
                        </section>

                        <thead>

                            <tr>
                                <th>
                                    <input id="all-checkbox" class="form-check-input" type="checkbox" value="">
                                </th>
                                <th>封面圖</th>
                                <th>標題</th>
                                <th>作者</th>
                                <th>分類</th>
                                <th>
                                    發布時間
                                </th>
                                <th>
                                    點讚數
                                </th>
                                <th>操作</th>
                            </tr>

                        </thead>
                        <tbody class="post-list">
                            <?php if(!isset($_GET['search'])): ?>
                            <?php foreach ($rows as $row) : ?>
                            <tr>
                                <td>
                                    <input class="form-check-input check-box" type="checkbox" value="<?=$row['id']?>">
                                </td>
                                <td>
                                    <a href="#" class="post-cover">
                                        <img src="./images/upload/<?= $row['URL_name'] ?>" alt=""
                                            class="object-fit-contain">
                                    </a>
                                </td>
                                <td class="post-title">
                                    <a href="article-editor.php?id=<?=$row['id']?>"
                                        title="<?= $row['title'] ?>"><?= $row['title'] ?></a>
                                </td>
                                <td><?= $row['author_name'] ?></td>
                                <td><?= $row['category_name'] ?></td>
                                <td class="release-time">
                                    <span class="status 
                                        <?php
                                        if ($row['status_id'] == 2) {
                                            echo "none";
                                        } else if ($row['status_id'] == 1) {
                                            echo "release";
                                        } else {
                                            echo "del";
                                        }
                                        ?>
                                        ">
                                        <?= $row['status_name'] ?>
                                    </span>
                                    <br>
                                    <span><?= $row['created_time'] ?></span>
                                </td>
                                <td>
                                    <?php
                                        $likeCount = 0;
                                        foreach ($rowsLike as $like) {
                                            if ($like['article_id'] == $row['id']) {
                                                $likeCount = $like['article_count'];
                                            }
                                        }
                                        echo $likeCount;
                                        ?>
                                </td>
                                <td>
                                    <a class="btn btn-primary"
                                        href="article-editor.php?id=<?=$row['id']?>&page=<?=$currentPage?>">編輯</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <tbody>
                            <?php if(isset($_GET['search'])): ?>
                            <?php foreach ($rows as $row) : ?>
                            <tr>
                                <td>
                                    <input class="form-check-input check-box" type="checkbox" value="<?=$row['id']?>">
                                </td>
                                <td>
                                    <a href="#" class="post-cover">
                                        <img src="./images/upload/<?= $row['URL_name'] ?>" alt=""
                                            class="object-fit-contain">
                                    </a>
                                </td>
                                <td class="post-title">
                                    <a href="article-editor.php?id=<?=$row['id']?>"
                                        title="<?= $row['title'] ?>"><?= $row['title'] ?></a>
                                </td>
                                <td><?= $row['author_name'] ?></td>
                                <td><?= $row['category_name'] ?></td>
                                <td class="release-time">
                                    <span class="status 
                                        <?php
                                        if ($row['status_id'] == 2) {
                                            echo "none";
                                        } else if ($row['status_id'] == 1) {
                                            echo "release";
                                        } else {
                                            echo "del";
                                        }
                                        ?>
                                        ">
                                        <?= $row['status_name'] ?>
                                    </span>
                                    <br>
                                    <span><?= $row['created_time'] ?></span>
                                </td>
                                <td>
                                    <?php
                                        $likeCount = 0;
                                        foreach ($rowsLike as $like) {
                                            if ($like['article_id'] == $row['id']) {
                                                $likeCount = $like['article_count'];
                                            }
                                        }
                                        echo $likeCount;
                                        ?>
                                </td>
                                <td>
                                    <a class="btn btn-primary"
                                        href="article-editor.php?id=<?=$row['id']?>&page=<?=$currentPage?>">編輯</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>

                    </table>

                    <section class="pagination justify-content-center">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <?php if($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="article-list.php?page=<?=$currentPage - 1 ?> 
                                        <?php if(isset($_GET['status']) && $_GET['status'] != ''): ?>
                                        &status=<?= $_GET['status'] ?>
                                        <?php endif; ?>
                                        <?php if(isset($_GET['category']) && $_GET['category'] != ''): ?>
                                        &category=<?= $_GET['category'] ?>
                                        <?php endif; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php for($i=1;$i<=$pageCount;$i++): ?>
                                <li class="page-item <?=($currentPage==$i)?'active':''?>"><a class="page-link" href="article-list.php?page=<?=$i?>
                                <?php if(isset($_GET['status']) && $_GET['status'] != ''): ?>
                                &status=<?= $_GET['status'] ?>
                                <?php endif; ?>
                                <?php if(isset($_GET['category']) && $_GET['category'] != ''): ?>
                                    &category=<?= $_GET['category'] ?>
                                <?php endif; ?>"><?=$i?></a>
                                </li>
                                <?php endfor; ?>

                                <?php if($currentPage < $pageCount): ?>
                                <li class="page-item">
                                    <a class="page-link" href="article-list.php?page=<?= $currentPage + 1 ?><?php if(isset($_GET['status']) && $_GET['status'] != ''): ?>
                                        &status=<?= $_GET['status'] ?>
                                        <?php endif; ?>
                                        <?php if(isset($_GET['category']) && $_GET['category'] != ''): ?>
                                        &category=<?= $_GET['category'] ?>
                                        <?php endif; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </section>

                    <!-- <div style="height: 100vh"></div> -->

                </div>
                </main>
            <footer class="py-4 bg-light mt-auto">
                <?php include("./style/footer.php");?>
            </footer>
        </div>
    </div>
    <!-- <script src="./js/scripts.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./js/all-delete.js"></script>

</body>

</html>