<?php
session_start();
include("include.php");
/* include("../style/sellerDashboard_sideNav.php"); */
/* include("../style/ysl-nav.php"); */
require_once("../includes/connect_sever.php");

/* $seller_id = 2; */ //測試
$seller_id = $_SESSION['seller_id'];


$itemsPerPage = 7;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //抓當下頁碼
$startIndex = ($page - 1) * $itemsPerPage; //算要抓那頁第幾個資料

$type_id=$_GET['type_id'];
$queryType = "SELECT * FROM type WHERE type.id = $type_id";
$resultType = $conn->query($queryType);
if ($resultType->num_rows > 0) {
    $typeInfo = $resultType->fetch_assoc();
    $defaultValues['name'] = $typeInfo['name'];
}



$query = "SELECT type.*,
type.name AS type_name, 
type.id AS type_id
FROM type
LIMIT $startIndex, $itemsPerPage";

$result = $conn->query($query);
$typeResult = $result->fetch_all(MYSQLI_ASSOC);

/* id升冪 */
if (isset($_GET["idUp"])) {
    $query = "SELECT type.*,
    type.name AS type_name, 
    type.id AS type_id
    FROM type
    ORDER BY type.id ASC
    LIMIT $startIndex, $itemsPerPage";
    $result = $conn->query($query);
    $idUpResult = $result->fetch_all(MYSQLI_ASSOC);
    $result->data_seek(0); // 重新將指針移回結果集開頭
} else if (isset($_GET["idDown"])) {
    $query = "SELECT type.*,
    type.name AS type_name, 
    type.id AS type_id
    FROM type
    ORDER BY type.id DESC
    LIMIT $startIndex, $itemsPerPage";
    $result = $conn->query($query);
    $idDownResult = $result->fetch_all(MYSQLI_ASSOC);
    $result->data_seek(0); // 重新將指針移回結果集開頭
}

/* 商品總數 */
$alltypecount = "SELECT COUNT(*) as total FROM type";
$totalItemsResult = $conn->query($alltypecount);
$allTypeItems = $totalItemsResult->fetch_assoc()["total"];

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
        .no_link {
            text-decoration: none;
            color: black;

            &:hover {
                text-decoration: none;
            }
        }
    </style>
</head>

<body class="sb-nav-fixed">
<?php include("../style/ysl-nav.php") ?>
    <div id="layoutSidenav">
    <?php include("../style/sellerDashboard_sideNav.php"); ?> <!-- 組別include -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <!-- <h1 class="mt-4">Tables</h1> -->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a class="no_link" href="index.html">首頁</a></li>
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
                        </div>
                        <form action="do_editt.php" method="post">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label" required>類型名稱：</label>
                                    <input type="hidden" name="type_id" value="<?= $type_id ?>">
                                    <input type="text" class="form-control" name="name" id="name" value="<?= $defaultValues['name'] ?>" required>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button type="submit" class="btn btn-warning">儲存</button>
                                        <a href="type.php" class="btn btn-danger text-end">取消</a>
                                    </div>
                                    <button title="確定新增並繼續編輯分類詳細支線" type="submit"
                                        class="btn btn-secondary">進階編輯</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
            <?php include("../style/footer.php"); ?>
        </div>
    </div>
</body>

</html>