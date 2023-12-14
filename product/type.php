<?php
session_start();
include("include.php");
/* include("../style/sellerDashboard_sideNav.php"); */
/* include("../style/ysl-nav.php"); */
require_once("../includes/connect_sever.php");

/* $seller_id = 2; */ //測試
$seller_id = $_SESSION['seller_id'];


$itemsPerPage = 7;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // 抓當下頁碼
$startIndex = ($page - 1) * $itemsPerPage; // 算要抓那頁第幾個資料
//基礎查詢先
$query = "SELECT type.*,
    type.name AS type_name, 
    type.id AS type_id
    FROM type
    WHERE type.valid=1";
//優先可能會使用的順序(最可能被重疊的)
if (isset($_GET["search"])) {
    $search = $_GET['search'];
    $query .= " AND type.name LIKE '%$search%'";

    // 計算搜尋結果的總數和頁數
    $searchCountQuery = "SELECT COUNT(*) as total FROM type WHERE type.name LIKE '%$search%'";
    $searchCountResult = $conn->query($searchCountQuery);
    $searchItems = $searchCountResult->fetch_assoc()["total"];
    $searchPages = ($searchItems > 0) ? ceil($searchItems / $itemsPerPage) : 0;
}

if (isset($_GET["idUp"])) {
    $query .= " ORDER BY type.id ASC";
} elseif (isset($_GET["idDown"])) {
    $query .= " ORDER BY type.id DESC";
}

$query .= " LIMIT $startIndex, $itemsPerPage";

$result = $conn->query($query);
$typeResult = $result->fetch_all(MYSQLI_ASSOC);

$alltypecount = "SELECT COUNT(*) as total FROM type";
$totalItemsResult = $conn->query($alltypecount);
$allTypeItems = $totalItemsResult->fetch_assoc()["total"];
$allTypePages = ($allTypeItems > 0) ? ceil($allTypeItems / $itemsPerPage) : 0;

/* 頁數 */
$allTypePages = ($allTypeItems > 0) ? ceil($allTypeItems / $itemsPerPage) : 0;

/* 用來顯示賣場的 */
$query = "SELECT product.*,
type.name AS type_name, 
rating.name AS rating_name,
rating.img AS rating_img,
ysl_seller.shop_name AS s_shop_name,
product.id AS product_id
FROM product 
JOIN type ON product.type_id = type.id
JOIN rating ON product.rating_id = rating.id
JOIN ysl_seller ON product.seller_id = ysl_seller.seller_id
WHERE product.seller_id = $seller_id
LIMIT $startIndex, $itemsPerPage";

$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>類別管理</title>
    <?php include("include.php"); ?>
    <style>
        .navbg {
            background: url(../style/img/background_nintendo_switch__2_by_kenji_cosplay_studio_demn0vs-pre.jpeg);
        }

        .no_link {
            text-decoration: none;
            color: black;
            &:hover {
                text-decoration: none;
                color: black;
            }
        }
    </style>
</head>

<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbg">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 text-white" href="index.html">Your Switch Life</a>
        <!-- Sidebar Toggle-->
        <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button> -->
        <div class="text-light d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">HELLO !
            <?= $_SESSION["member"]['name'] ?>
        </div>
        <!-- Navbar Search-->
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
    <?php include("../style/sellerDashboard_sideNav.php"); ?> <!-- 組別include -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <!-- <h1 class="mt-4">Tables</h1> -->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a class="no_link" href="../seller/seller_dashboard.php">首頁</a></li>
                        <li class="breadcrumb-item active">商品管理</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h3><i class="fas fa-table"></i>
                                    <?php $row = $result->fetch_assoc(); ?>
                                    <?= $row["s_shop_name"] ?> 賣場
                                </h3>
                            </div>
                            <div class="btn-group">
                                <a type="button" class="btn btn-danger" href="add_type.php">新增分類</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <form action="type.php" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="搜尋分類" name="search">
                                        <div class="col-auto">
                                            <button class="btn border-0" type="submit">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="btn-group d-flex align-items-center">
                                    建立時間：
                                <a class="btn btn-warning text-white" href="type.php?idDown<?= isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>">新<i class="bi bi-caret-down-fill"></i></a>
                                <a class="btn btn-secondary" href="type.php?idUp<?= isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>">舊<i class="bi bi-caret-up-fill"></i></a>
                                </div>
                            </div>
                            <!-- table -->
                            <div class="container">
                                <table class="table mt-4 container">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="col-3">
                                                類別名稱
                                            </th>
                                            <th class="col-2">編輯類別
                                            </th>
                                            <th class="col-2">
                                                刪除類別
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- tbody -->
                                    <tbody>
                                        <?php
                                        /* if (isset($_GET["search"])) {
                                            $resultArray = $searchResult;
                                        } elseif (isset($_GET["idUp"])) {
                                            $resultArray = $idUpResult;
                                        } elseif (isset($_GET["idDown"])) {
                                            $resultArray = $idDownResult;
                                        } else {
                                            $resultArray = $typeResult;
                                        } */

                                        foreach ($typeResult as $row):
                                            ?>
                                            <tr>
                                                <td class="col-6">
                                                    <?= $row["type_name"] ?>
                                                </td>
                                                <td class="col-2">
                                                    <a title="編輯類別" href="edit_type.php?type_id=<?= $row['type_id'] ?>"> <i class="bi bi-pencil-square"></i></a>
                                                   
                                                </td>
                                                <td class="col-2">
                                                    <a title="刪除類別" href="type_sdelete.php?type_id=<?= $row['type_id'] ?>"
                                                        onclick="return confirm('確定要刪除嗎？')">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                            <nav class="d-flex justify-content-center">
                                <div class="col-auto">
                                    <a title="返回第一頁" class="btn btn-secondary text-white" href="type.php"><i
                                            class="bi bi-reply-all-fill"></i></a>
                                </div>
                                <ul class="pagination">
                                    <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                                        <a title="上一頁" class="page-link" href="type.php?page=<?= $page - 1; ?>"
                                            aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php
                                    $paginationUrl = isset($_GET['search']) ? 'type.php?search=' . $_GET['search'] . '&page=' : 'type.php?page=';

                                    for ($i = 1; $i <= (isset($_GET['search']) ? $searchPages : $allTypePages); $i++):
                                        ?>
                                        <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                                            <a class="page-link" href="<?= $paginationUrl . $i; ?>">
                                                <?= $i; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>

                                    <li class="page-item <?= ($page == (isset($_GET['search']) ? $searchPages : $allTypePages)) ? 'disabled' : ''; ?>">
                                        <a title="下一頁" class="page-link" href="type.php?page=<?= $page + 1; ?>"
                                            aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <p class="text-center">
                                總共有
                                <?= (isset($_GET['search']) ? $searchItems : $allTypeItems) ?? 0 ?> 個分類，共
                                <?= (isset($_GET['search']) ? $searchPages : $allTypePages) ?? 0 ?> 頁。
                            </p>
                        </div>
                    </div>
                </div>
            </main>
            <?php include("../style/footer.php"); ?>
        </div>
    </div>
</body>

</html>