<?php

require_once("../comm/dbo_connect.php");

$currentPage = isset($_GET['page']) ? $_GET['page']:1;
$perpage = 6;

if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $sql = "SELECT article.*, article_author.name AS author_name, article_img.URL_name, article_category.name AS category_name, article_status.name AS status_name
FROM  article
JOIN article_author ON article.author_id =  article_author.id  
JOIN article_img ON article.img_id =  article_img.id 
JOIN article_category ON article.category_id =  article_category.id 
JOIN article_status ON article.status_id =  article_status.id 
WHERE  article.status_id =  $status
ORDER BY article.id ASC";
} else {
    $sql = "SELECT article.*, article_author.name AS author_name, article_img.URL_name, article_category.name AS category_name, article_status.name AS status_name
    FROM  article
    JOIN article_author ON article.author_id =  article_author.id  
    JOIN article_img ON article.img_id =  article_img.id 
    JOIN article_category ON article.category_id =  article_category.id 
    JOIN article_status ON article.status_id =  article_status.id 
    WHERE valid=1
    ORDER BY article.id ASC";

}

$result = $conn->query($sql);
//文章總數量
$totalArticle= $result->num_rows;
//需要幾頁
$pageCount = ceil($totalArticle / $perpage);

//計算每一頁從哪一編號開始
$startItem = ($currentPage - 1)*$perpage;

$sql.= " LIMIT $perpage OFFSET $startItem";
$result = $conn->query($sql);
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
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/article-table.css?=<?= time(); ?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand shadow-sm">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 fw-bold text-white" href="index.html">YOUR SWITCH LIFE</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion" id="sidenavAccordion">
                <div class="sb-sidenav-menu shadow-sm">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading ">Core</div>
                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <pre>
                        <?php
                        //print_r($rows);
                        ?>
                    </pre>
                    <ol class="breadcrumb mb-4 mt-3">
                        <li class="breadcrumb-item"><a href="index.html">文章管理</a></li>
                        <li class="breadcrumb-item active">文章列表</li>
                    </ol>

                    <section class="header d-flex justify-content-between">
                        <div class="input-search input-group ">
                            <input type="text" class="form-control" placeholder="請輸入關鍵字" name="search" id="search" value="">
                            <button class="input-group-text send" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                        
                        <div class="input-right d-flex ">
                            <select class="form-select">
                                <option selected>依分類篩選</option>
                                <option value="1">遊戲攻略</option>
                                <option value="2">發售資訊</option>
                                <option value="3">遊戲報報</option>
                                <option value="3">試玩報導</option>
                            </select>
                            <button class="all-del btn btn-danger">批次刪除</button>
                            <button class="add-post btn btn-primary"><i class="fa-solid fa-plus"></i> 新增文章</button>
                        </div>
                    </section>
                    <?php if(isset($_GET['search'])): ?>
                    <section>
                        <div class="search-sub">查詢<?=$_GET['search']?>的結果</div>
                    </section>
                    <?php endif; ?>
                    <table class="main-table mb-3">
                        <section class="article-status">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link <?php if (!isset($_GET['status'])) echo "active"; ?>" aria-current="page" href="article-list.php">全部</a>
                                </li>
                                <?php foreach ($rowStatus as $status) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link 
                                        <?php
                                        if (isset($_GET['status']) && $_GET['status'] == $status['id']) echo "active";
                                        ?>" href="article-list.php?status=<?= $status['id'] ?>"><?= $status['name'] ?></a>
                                    </li>
                                <?php endforeach; ?>

                            </ul>
                        </section>

                        <thead>

                            <tr>
                                <th>
                                    <input class="form-check-input" type="checkbox" value="">
                                </th>
                                <th>封面圖</th>
                                <th>標題</th>
                                <th>作者</th>
                                <th>分類</th>
                                <th>發布時間</th>
                                <th>點讚數</th>
                                <th>詳情</th>
                                <th>操作</th>
                            </tr>

                        </thead>
                        <tbody class="post-list">
                            <?php foreach ($rows as $row) : ?>
                                <tr>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="">
                                    </td>
                                    <td>
                                        <a href="#" class="post-cover">
                                            <img src="../images/<?= $row['URL_name'] ?>" alt="" class="object-fit-contain">
                                        </a>
                                    </td>
                                    <td class="post-title">
                                        <a href="#" title="<?= $row['title'] ?>"><?= $row['title'] ?></a>
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
                                        <button class="btn btn-secondary">查看</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-secondary">編輯</button>
                                        <button class="btn btn-danger">刪除</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                    <section class="pagination justify-content-center">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <?php if($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="article-list.php?page=<?=$currentPage - 1 ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php for($i=1;$i<=$pageCount;$i++): ?>
                                <li class="page-item <?=($currentPage==$i)?'active':''?>"><a class="page-link" href="article-list.php?&page=<?=$i?>"><?=$i?></a></li>
                                <?php endfor; ?>

                                <?php if($currentPage < $pageCount): ?>
                                <li class="page-item">
                                    <a class="page-link" href="article-list.php?page=<?= $currentPage + 1 ?>" aria-label="Next">
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
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        const search = document.querySelector("#search");
        const send = document.querySelector(".send");

        send.addEventListener("click", function(){
            let searchVal = search.value;
            $.ajax({
                method:"POST",
                url:"../api/search.php",
                dataType:"json",
                data:{
                    search:searchVal
                }
                
            })
            .done(function(reponse){
                let data=reponse.data;
                

            }).fail(function(jqXHR, textStatus){
                console.log( "Request failed: " + textStatus );
            })
        })
    </script>
</body>

</html>