<?php
session_start();
include("include.php");
require_once("../includes/connect_sever.php");

/* $seller_id = 2; */  //測試
$seller_id = $_SESSION['seller_id'];


$itemsPerPage = 7;
$page = isset($_GET['page']) ? ($_GET['page']) : 1; //抓當下頁碼
$startIndex = ($page - 1) * $itemsPerPage; //算要抓那頁第幾個資料


// 篩選條件陣列
$filterConditions = [];

/* 賣場顯示 */
$query = "SELECT *,
ysl_seller.shop_name AS s_shop_name
FROM ysl_seller
WHERE ysl_seller.seller_id = $seller_id
LIMIT 1";
$shopResult = $conn->query($query);
$shopRow = $shopResult->fetch_assoc();

// 賣家預設基本商品列表
$query = "SELECT product.*, type.name AS type_name, rating.name AS rating_name, rating.img AS rating_img, ysl_seller.shop_name AS s_shop_name, product.id AS product_id
FROM product 
JOIN type ON product.type_id = type.id
JOIN rating ON product.rating_id = rating.id
JOIN ysl_seller ON product.seller_id = ysl_seller.seller_id";

// 加入搜尋條件
if (isset($_GET["search"])) {
    $search = $_GET['search'];
    $filterConditions[] = "product.name LIKE '%$search%'";
}

//價格篩選
if (isset($_GET["price-min"]) && isset($_GET["price-max"])) {
    $priceMin = $_GET["price-min"];
    $priceMax = $_GET["price-max"];

    $filterConditions[] = "product.price > '$priceMin' AND product.price < '$priceMax'";
    /* $orderConditions[] = "ORDER BY price ASC"; */
    /* $result = $conn->query($sql);
    $productCount = $result->num_rows;
    $rows = $result->fetch_all(MYSQLI_ASSOC); */
}

//加入類別顯示 及 篩選
$categoryQuery = "SELECT DISTINCT type.*,
type.name AS type_name
FROM type 
JOIN product ON product.type_id = type.id
WHERE product.seller_id = $seller_id";
$filterCategory = $conn->query($categoryQuery);

if (isset($_GET["type"])) {
    $type = $_GET["type"];
    $filterConditions[] = "product.type_id=$type";
}

//加入級別顯示 及 篩選
$ratingQuery = "SELECT DISTINCT rating.*,
rating.name AS rating_name
FROM rating
JOIN product ON product.rating_id = rating.id
WHERE product.seller_id = $seller_id";
$filterRating = $conn->query($ratingQuery);

if (isset($_GET["rating"])) {
    $rating = $_GET["rating"];
    $filterConditions[] = "product.rating_id=$rating";
}

//加入語言顯示 及 篩選
$languageQuery = "SELECT * FROM product WHERE (CH = 1 OR EN = 1 OR JN = 1) AND seller_id = $seller_id";
$filterLanguage = $conn->query($languageQuery);

if (isset($_GET["CH"])) {
    $CH = $_GET["CH"];
    $filterConditions[] = "CH = 1";
}

if (isset($_GET["EN"])) {
    $EN = $_GET["EN"];
    $filterConditions[] = "EN = 1";
}
if (isset($_GET["JN"])) {
    $JN = $_GET["JN"];
    $filterConditions[] = "JN = 1";
}

// 加入價格排序條件
if (isset($_GET["priceUp"])) {
    $priceUp = $_GET['priceUp'];
    $orderConditions[] = "ORDER BY price ASC";
}
if (isset($_GET["priceDown"])) {
    $priceDown = $_GET['priceDown'];
    $orderConditions[] = "ORDER BY price DESC";
}

//加入上架時間排序條件
if (isset($_GET["doUp"])) {
    $doUp = $_GET['doUp'];
    $orderConditions[] = "ORDER BY product.created_at ASC";
}
if (isset($_GET["doDown"])) {
    $doDown = $_GET['doDown'];
    $orderConditions[] = "ORDER BY product.created_at DESC";
}

//WHERE
$query .= " WHERE product.seller_id = $seller_id AND exist_valid = 1";

//AND
if (!empty($filterConditions)) {
    $query .= ' AND ' . implode(' AND ', $filterConditions);
}

//ORDER BY (注意順序問題不然會報錯)
if (!empty($orderConditions)) {
    $query .= ' ' . implode(' ', $orderConditions);
}

//LIMIT
$query .= " LIMIT $startIndex, $itemsPerPage";


// 計算總數的 SQL 基本查詢
$totalItemsQuery = "SELECT COUNT(*) AS totalItems FROM product WHERE seller_id = $seller_id AND exist_valid = 1";

// 有篩選條件的 SQL 查詢
if (!empty($filterConditions)) {
    $totalItemsQuery .= ' AND ' . implode(' AND ', $filterConditions);
}

// 執行查詢
$result = $conn->query($query);
$rows = $result->fetch_all(MYSQLI_ASSOC);

$totalItemsResult = $conn->query($totalItemsQuery);
$totalItems = $totalItemsResult->fetch_assoc()["totalItems"];

// 計算頁數
$totalPages = ceil($totalItems / $itemsPerPage);

// 記憶篩選 GET 用

$filtersArray = [
    'type' => isset($type) ? $type : null,
    'rating' => isset($rating) ? $rating : null,
    'search' => isset($search) ? $search : null,
    'priceUp' => isset($priceUp) ? $priceUp : null,
    'priceDown' => isset($priceDown) ? $priceDown : null,
    'doUp' => isset($doUp) ? $doUp : null,
    'doDown' => isset($doDown) ? $doDown : null,
    'CH' => isset($CH) ? $CH : null,
    'EN' => isset($EN) ? $EN : null,
    'JN' => isset($JN) ? $JN : null,
    'price-min' => isset($priceMin) ? $priceMin : null,
    'price-max' => isset($priceMax) ? $priceMax : null,

];

// 使用 function 移除空值
$filters = array_filter($filtersArray, function ($value) {
    return $value !== null && $value !== '';
});

// 使用 array_unique 移除陣列中的重複值
/* $filter = array_unique($filters); */

// 賦值
$filterString = http_build_query($filters);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>商品管理</title>
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
                        <li class="breadcrumb-item"><a class="no_link" href="../seller/seller_dashboard.php">首頁</a></li>
                        <li class="breadcrumb-item active">商品管理</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h3><i class="fas fa-table"></i>
                                    <?= $shopRow["s_shop_name"] ?> 賣場
                                </h3>
                            </div>
                            <div class="btn-group">
                                <a type="button" class="btn btn-danger" href="add_product.php">新增商品</a>
                                <a type="button" class="btn btn-warning rounded-end" href="edit_product.php?<?= $filterString ?>">編輯模式</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <form action="product_list.php?" method="GET">
                                    <div class="input-group">

                                        <input type="text" class="form-control" placeholder="搜尋商品" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                        <div class="col-auto">
                                            <button class="btn border-0" type="submit">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <form action="product_list.php?<?= $filterString ?>" method="get" class="py-3 d-flex justify-content-between">
                                    <div class="row g-2 align-items-center">
                                        <div class="col-auto ps-5">
                                            <label for="" class="col-form-label">價格：</label>
                                        </div>
                                        <div class="col-2">
                                            <input type="number" class="form-control text-end price-input" name="price-min" value="<?php echo isset($_GET["price-min"]) ? htmlspecialchars($_GET["price-min"]) : 0; ?>">
                                        </div>
                                        <div class="col-auto">
                                            ~
                                        </div>
                                        <div class="col-2">
                                            <input type="number" class="form-control text-end price-input" name="price-max" value="<?php echo isset($_GET["price-max"]) ? htmlspecialchars($_GET["price-max"]) : 99999; ?>">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-outline-dark">篩選</button>
                                        </div>
                                    </div>
                                </form>

                                <form method="get" action="product_list.php" class="btn-group ms-auto" role="group">
                                    <div class="btn-group" role="group">
                                        <a title="返回全部商品" class="btn btn-dark text-white" href="product_list.php"><i class="bi bi-reply-all-fill"></i> 全部</a>

                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            類別
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($filterCategory as $type) : ?>
                                                <li class="dropdown-item <?php echo isset($_GET['type']) && $_GET['type'] == $type['id'] ? 'active' : ''; ?>">
                                                    <a class="no_link" href="product_list.php?<?= $filterString ?>&type=<?= $type['id'] ?>">
                                                        <?= $type["type_name"] ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            級別
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($filterRating as $rating) : ?>
                                                <li class="dropdown-item <?php echo isset($_GET['rating']) && $_GET['rating'] == $rating['id'] ? 'active' : ''; ?>">
                                                    <a class="no_link" href="product_list.php?<?= $filterString ?>&rating=<?= $rating['id'] ?>">
                                                        <?= $rating["rating_name"] ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            語言
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="">
                                                    <?php
                                                    $uniqueLanguages = array(); // 追蹤已經出現的語言
                                                    foreach ($filterLanguage as $lang) {
                                                        if ($lang["CH"] !== '' && !in_array('中文', $uniqueLanguages)) {
                                                            echo "<li><a class='dropdown-item' href='product_list.php?$filterString&CH=1'>中文</a></li>";
                                                            $uniqueLanguages[] = '中文';
                                                        }

                                                        if ($lang["EN"] !== '' && !in_array('英文', $uniqueLanguages)) {
                                                            echo "<li><a class='dropdown-item' href='product_list.php?$filterString&EN=1'>英文</a></li>";
                                                            $uniqueLanguages[] = '英文';
                                                        }

                                                        if ($lang["JN"] !== '' && !in_array('日文', $uniqueLanguages)) {
                                                            echo "<li><a class='dropdown-item' href='product_list.php?$filterString&JN=1'>日文</a></li>";
                                                            $uniqueLanguages[] = '日文';
                                                        }
                                                    }
                                                    ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                            <!-- table -->
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>商品快圖</th>
                                        <th class="col-2">名稱</th>
                                        <th>類別</th>
                                        <th>分級</th>
                                        <th>支援語言</th>
                                        <th>價格<a href="product_list.php?priceDown&<?= $filterString ?>"><i class="bi bi-caret-down-fill"></i></a>
                                            <a href="product_list.php?priceUp&<?= $filterString ?>"><i class="bi bi-caret-up-fill"></i></a>
                                        </th>
                                        <th>上架時間
                                            <a href="product_list.php?<?= $filterString ?>&doDown"><i class="bi bi-caret-down-fill"></i></a>
                                            <a href="product_list.php?<?= $filterString ?>&doUp"><i class="bi bi-caret-up-fill"></i></a>
                                        </th>
                                        <th>商品狀態 / 資訊</th>
                                    </tr>
                                </thead>
                                <!-- tbody -->
                                <tbody>
                                    <?php foreach ($rows as $row) : ?>
                                        <tr>
                                            <td>
                                                <?php
                                                /* $createdTime = strtotime($row["created_at"]); */
                                                // 如果 $createdTime 大於等於指定的時間（2023/12/09 00:00:00）
                                                /* if ($createdTime > strtotime("2023-12-09 00:00:00")) {
                                                    這樣重複抓時間戳記會再原本檔名上再附一次時間戳記導致抓不到 
                                                    $timestamp = time();
                                                    $imgFileName = $timestamp . "_" . $row["img"];
                                                    $imagePath = "upload/" . $row["img"]; //新資料讀這裡
                                                } else {
                                                    $imagePath = "images/" . $row["img"]; //舊資料讀這裡
                                                } */
                                                $imagePath = "images/" . $row["img"];
                                                ?>
                                                <figure class="img">
                                                    <img class="ob_fit" src="<?= $imagePath ?>" alt="<?= $row["name"] ?>">
                                                </figure>
                                            </td>
                                            <td>
                                                <?= $row["name"] ?>
                                            </td>
                                            <td>
                                                <?= $row["type_name"] ?>
                                            </td>
                                            <td>
                                                <figure><img width="50px" src="rating_img/<?= $row["rating_img"] ?>" alt="<?= $row["rating_name"] ?>"></figure>
                                            </td>
                                            <td> <!-- 支援語言 -->
                                                <?php
                                                $languages = "";
                                                if ($row["CH"] == 1) {
                                                    $languages .= "中";
                                                }
                                                if ($row["EN"] == 1) {
                                                    $languages .= $languages ? ", 英" : "英";
                                                }
                                                if ($row["JN"] == 1) {
                                                    $languages .= $languages ? ", 日" : "日";
                                                }
                                                echo $languages;
                                                ?>
                                            </td>
                                            <td>
                                                <?= "$ " . number_format($row["price"]) ?>
                                            </td>
                                            <td>
                                                <?= $row["created_at"] ?>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="toggleSwitch<?= $row['product_id'] ?>" data-product-id="<?= $row['product_id'] ?>" data-valid="<?= $row['valid'] ?>" <?php echo ($row['valid'] == 1) ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label" for="toggleSwitch<?= $row['product_id'] ?>">
                                                        <?= ($row['valid'] == 1) ? '公開' : '隱藏' ?>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <nav class="d-flex justify-content-center">

                                <ul class="pagination">
                                    <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                                        <a title="上一頁" class="page-link" href="product_list.php?page=<?= $page - 1; ?>&<?= $filterString ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php
                                    for ($i = 1; $i <= $totalPages; $i++) : ?>
                                        <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                                            <a class="page-link" href="product_list.php?page=<?= $i; ?>&<?= $filterString ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?php echo ($page == $totalPages) ? 'disabled' : ''; ?>">
                                        <a title="下一頁" class="page-link" href="product_list.php?page=<?= $page + 1; ?>&<?= $filterString ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>

                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <p class="text-center">
                                總共有
                                <?= $totalItems ?> 件商品，共
                                <?= $totalPages ?> 頁。
                            </p>
                        </div>
                    </div>
                </div>
            </main>
            <?php include("../style/footer.php"); ?>
        </div>
    </div>
    <script>
        /* AJAX */
        document.addEventListener('DOMContentLoaded', function() {
            var toggleSwitches = document.querySelectorAll('.custom-control-input');

            toggleSwitches.forEach(function(toggleSwitch) {
                toggleSwitch.addEventListener('change', function() {
                    var productId = toggleSwitch.getAttribute('data-product-id');
                    var currentValid = toggleSwitch.getAttribute('data-valid');
                    var newValid = (currentValid == 1) ? 0 : 1;

                    // 傳送 Ajax 到後端
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            console.log(xhr.responseText);
                            $(toggleSwitch).closest('.custom-switch').bootstrapSwitch('state', newValid);
                        }
                    };
                    xhr.open('POST', 'update_valid.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send('product_id=' + productId + '&new_valid=' + newValid);

                    // 更新文字
                    toggleSwitch.nextElementSibling.innerText = (newValid == 1) ? '公開' : '隱藏';

                    // 更新 data-valid 屬性的值
                    toggleSwitch.setAttribute('data-valid', newValid);
                });
            });
        });
    </script>
</body>

</html>