<?php
require_once("../db_connect.php");

// 假設登入用POST方法
/* $loginSeller = $_POST["member_identity"]; */
$seller_id = 2; //測試

$itemsPerPage = 7;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //抓當下頁碼
$startIndex = ($page - 1) * $itemsPerPage; //算要抓那頁第幾個資料

/* 賣家商品列表 */
if (isset($_GET["search"])) {
    $search = $_GET['search'];
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
    WHERE product.name LIKE '%$search%' AND product.seller_id = $seller_id
    LIMIT $startIndex, $itemsPerPage";

    $result = $conn->query($query);
    $searchResult = $result->fetch_all(MYSQLI_ASSOC);
    $query = "SELECT COUNT(*) AS totalItems
        FROM product 
        JOIN type ON product.type_id = type.id
        JOIN rating ON product.rating_id = rating.id
        JOIN ysl_seller ON product.seller_id = ysl_seller.seller_id
        WHERE product.name LIKE '%$search%' AND product.seller_id = $seller_id";
    $totalItemsResult = $conn->query($query);
    $totalItemsRow = $totalItemsResult->fetch_assoc();
    $searchItems = $totalItemsRow['totalItems'];
}


/* 篩選(類別) */
$categoryQuery = "SELECT DISTINCT type.*,
type.name AS type_name
FROM type 
JOIN product ON product.type_id = type.id
WHERE product.seller_id = $seller_id";
$filterCategory = $conn->query($categoryQuery);


/* 篩選(級別) */
$ratingQuery = "SELECT DISTINCT rating.*,
rating.name AS rating_name
FROM rating
JOIN product ON product.rating_id = rating.id
WHERE product.seller_id = $seller_id";
$filterRating = $conn->query($ratingQuery);

/* 篩選(語言) */
$languageQuery = "SELECT * FROM product WHERE (CH = 1 OR EN = 1 OR JN = 1) AND seller_id = $seller_id";
$filterLanguage = $conn->query($languageQuery);

/* 商品總數 */
$totalItems = "SELECT COUNT(*) as total FROM product WHERE seller_id = $seller_id";
$totalItemsResult = $conn->query($totalItems);
$totalItems = $totalItemsResult->fetch_assoc()["total"];

/* 頁數 */
$totalPages = ceil($totalItems / $itemsPerPage);
$searchPages = ceil($searchItems / $itemsPerPage);

function filterQuery()
{
    $filterQueryString = '';

    if (isset($_GET['type'])) {
        $filterQueryString .= '&type=' . $_GET['type'];
    }
    if (isset($_GET['rating'])) {
        $filterQueryString .= '&rating=' . $_GET['rating'];
    }
    if (isset($_GET['CH'])) {
        $filterQueryString .= '&CH=' . $_GET['CH'];
    }
    if (isset($_GET['EN'])) {
        $filterQueryString .= '&EN=' . $_GET['EN'];
    }
    if (isset($_GET['JN'])) {
        $filterQueryString .= '&JN=' . $_GET['JN'];
    }
    if (isset($_GET['price-min']) && isset($_GET['price-max'])) {
        $filterQueryString .= '&price-min=' . $_GET['price-min'] . '&price-max=' . $_GET['price-max'];
    }
    if (isset($_GET["search"])) {
        $filterQueryString .= '&search=' . $_GET['search'];
    }
    return $filterQueryString;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables - SB Admin</title>
    <?php include("include.php"); ?>
</head>

<body class="sb-nav-fixed searchResultContainer">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
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
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
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
                        <a class="nav-link" href="product_list.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            商品管理
                        </a>
                        <a class="nav-link" href="type.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            類別管理
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
                    <!-- <h1 class="mt-4">Tables</h1> -->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">商品管理</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h3><i class="fas fa-table"></i>
                                    <?php if (isset($_GET["price-min"]) && isset($_GET["price-max"])) : ?>
                                        <?php foreach ($rows as $row) : ?>
                                            <?= $row["s_shop_name"] . " 賣場"; ?>
                                            <?php break; ?>
                                        <?php endforeach; ?>
                                    <?php elseif (isset($_GET["search"])) : ?>
                                        <?php foreach ($searchResult as $row) : ?>
                                            <?= $row["s_shop_name"] . " 賣場"; ?>
                                            <?php break; ?>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <?php $row = $result->fetch_assoc(); ?>
                                        <?= $row["s_shop_name"] ?> 賣場
                                    <?php endif; ?>

                                </h3>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-danger">新增商品</button>
                                <button type="button" class="btn btn-secondary">編輯商品</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <form action="search.php" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="搜尋商品" name="search">
                                        <div class="col-auto">
                                            <button class="btn border-0" type="submit">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <form action="product_list.php" method="get" class="py-3">
                                    <div class="row g-2 align-items-center">
                                        <?php if (isset($_GET["price-min"])) : ?>
                                        <?php endif; ?>
                                        <div class="col-auto ps-5">
                                            <label for="" class="col-form-label">價格</label>
                                        </div>
                                        <div class="col-auto">
                                            <input type="number" class="form-control text-end price-input" name="price-min" value="<?php $priceMin = isset($_GET["price-min"]) ? $min : 0;
                                                                                                                                    echo $priceMin; ?>">
                                        </div>
                                        <div class="col-auto">
                                            ~
                                        </div>
                                        <div class="col-auto">
                                            <input type="number" class="form-control text-end price-input" name="price-max" value="<?php $priceMax = isset($_GET["price-max"]) ? $max : 99999;
                                                                                                                                    echo $priceMax; ?>">
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-outline-dark" type="submit">篩選</button>
                                        </div>
                                    </div>
                                </form>
                                <form method="get" action="product_list.php" class="btn-group ms-auto" role="group">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            類別
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($filterCategory as $type) : ?>
                                                <li class="dropdown-item"><a href="product_list.php?type=<?= $type["id"] ?>">
                                                        <?= $type["type_name"] ?>
                                                    </a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            級別
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($filterRating as $rating) : ?>
                                                <li><a class="dropdown-item" href="product_list.php?rating=<?= $rating["id"] ?>">
                                                        <?= $rating["rating_name"] ?>
                                                    </a></li>
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
                                                            echo "<li><a class='dropdown-item' href='product_list.php?CH=1'>中文</a></li>";
                                                            $uniqueLanguages[] = '中文';
                                                        }

                                                        if ($lang["EN"] !== '' && !in_array('英文', $uniqueLanguages)) {
                                                            echo "<li><a class='dropdown-item' href='product_list.php?EN=1'>英文</a></li>";
                                                            $uniqueLanguages[] = '英文';
                                                        }

                                                        if ($lang["JN"] !== '' && !in_array('日文', $uniqueLanguages)) {
                                                            echo "<li><a class='dropdown-item' href='product_list.php?JN=1'>日文</a></li>";
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
                                        <th class="col-3">名稱</th>
                                        <th>類別</th>
                                        <th>分級</th>
                                        <th>支援語言</th>
                                        <th>價格<i class="bi bi-caret-down-fill"></i><i class="bi bi-caret-up-fill"></i>
                                        </th>
                                        <th>上架時間<i class="bi bi-caret-down-fill"></i><i class="bi bi-caret-up-fill"></i>
                                        </th>
                                        <th>商品狀態 / 資訊</th>
                                    </tr>
                                </thead>
                                <!-- tbody -->
                                <tbody>
                                    <?php foreach ($searchResult as $row) : ?>
                                        <tr>
                                            <td>
                                                <figure class="img"><img class="ob_fit" src="images/<?= $row["img"] ?> " alt="<?= $row["name"] ?>"></figure>
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
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <nav class="d-flex justify-content-center">
                                <div class="col-auto">
                                    <a title="返回全部商品" class="btn btn-secondary text-white" href="product_list.php"><i class="bi bi-reply-all-fill"></i></a>
                                </div>
                                <ul class="pagination">
                                    <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                                        <a title="上一頁" class="page-link" href="search.php?page=<?php echo $page - 1; ?><?php echo filterQuery(); ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php
                                    $totalPagesToShow = null;

                                    if (isset($_GET["type"])) {
                                        $totalPagesToShow = $typePages;
                                    } elseif (isset($_GET["rating"])) {
                                        $totalPagesToShow = $ratingPages;
                                    } elseif (isset($_GET["CH"])) {
                                        $totalPagesToShow = $CHPages;
                                    } elseif (isset($_GET["EN"])) {
                                        $totalPagesToShow = $ENPages;
                                    } elseif (isset($_GET["JN"])) {
                                        $totalPagesToShow = $JNPages;
                                    } elseif (isset($_GET["price-min"]) && isset($_GET["price-max"])) {
                                        $totalPagesToShow = $pricePages;
                                    } elseif (isset($_GET["search"])) {
                                        $totalPagesToShow = $searchPages;
                                    } elseif ($totalPages !== null) {
                                        $totalPagesToShow = $totalPages;
                                    } else {
                                        $totalPagesToShow = 1; // 預設至少有一頁
                                    }

                                    for ($i = 1; $i <= $totalPagesToShow; $i++) : ?>
                                        <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                            <a class="page-link" href="search.php?page=<?php echo $i; ?><?php echo filterQuery(); ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?php echo ($page == $totalPagesToShow) ? 'disabled' : ''; ?>">
                                        <a title="下一頁" class="page-link" href="search.php?page=<?php echo $page + 1; ?><?php echo filterQuery(); ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <p class="text-center">
                                <?php
                                $categories = ["type", "rating", "CH", "EN", "JN", "price"];
                                $priceFilterActive = isset($_GET["price-min"]) && isset($_GET["price-max"]);
                                $searchActive = isset($_GET["search"]);

                                switch (true) {
                                    case $priceFilterActive:
                                        $item = "priceItems";
                                        $page = "pricePages";
                                        break;

                                    case isset($_GET["type"]):
                                        $item = "typeItems";
                                        $page = "typePages";
                                        break;

                                    case isset($_GET["rating"]):
                                        $item = "ratingItems";
                                        $page = "ratingPages";
                                        break;

                                    case isset($_GET["CH"]):
                                        $item = "CHItems";
                                        $page = "CHPages";
                                        break;

                                    case isset($_GET["EN"]):
                                        $item = "ENItems";
                                        $page = "ENPages";
                                        break;

                                    case isset($_GET["JN"]):
                                        $item = "JNItems";
                                        $page = "JNPages";
                                        break;

                                    case $searchActive:
                                        $item = "searchItems";
                                        $page = "searchPages";
                                        break;

                                    default:
                                        $item = "totalItems";
                                        $page = "totalPages";
                                        break;
                                }
                                ?>

                                總共有
                                <?= $$item ?? 0 ?> 件商品，共
                                <?= $$page ?? 0 ?> 頁。
                            </p>
                        </div>
                    </div>
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
</body>

</html>