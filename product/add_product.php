<?php
session_start();
include("include.php");
/* include("../style/sellerDashboard_sideNav.php"); */
/* include("../style/ysl-nav.php"); */
require_once("../includes/connect_sever.php");

/* $seller_id = 2; */ //測試
$seller_id = $_SESSION['seller_id'];

$query = "SELECT product.*,
type.name AS type_name, 
rating.name AS rating_name,
rating.img AS rating_img,
ysl_seller.shop_name AS s_shop_name
FROM product 
JOIN type ON product.type_id = type.id
JOIN rating ON product.rating_id = rating.id
JOIN ysl_seller ON product.seller_id = ysl_seller.seller_id
WHERE product.seller_id = $seller_id";

$result = $conn->query($query);


/* 類別 */
$categoryQuery = "SELECT DISTINCT type.*,
type.name AS type_name
FROM type ";
$filterCategory = $conn->query($categoryQuery);

/* 級別 */
$ratingQuery = "SELECT DISTINCT rating.*,
rating.name AS rating_name
FROM rating ";
$filterRating = $conn->query($ratingQuery);


/* 圖片 */
$sql = "SELECT product.img FROM product ORDER BY id DESC LIMIT 1";
$imgResult = $conn->query($sql);
$img = $imgResult->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>商品新增</title>
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
                                    <?php if (isset($_GET["price-min"]) && isset($_GET["price-max"])): ?>
                                        <?php foreach ($rows as $row): ?>
                                            <?= $row["s_shop_name"] . " 賣場"; ?>
                                            <?php break; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php $row = $result->fetch_assoc(); ?>
                                        <?= $row["s_shop_name"] ?> 賣場
                                    <?php endif ?>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container mt-2">
                                <form action="do_addp.php" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="type_id" class="form-label">商品類型：</label>
                                        <select class="form-select" name="type_id" id="type_id">
                                            <?php foreach ($filterCategory as $type): ?>
                                                <option value="<?= $type["id"] ?>">
                                                    <?= $type["type_name"] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label" required>商品名稱：</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label" required>商品價格：</label>
                                        <input type="number" class="form-control" name="price" id="price" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="img" class="form-label">商品列表圖片：</label>
                                        <input type="file" class="form-control" name="img" id="img" accept="image/*"
                                            onchange="previewImage()">

                                        <p class="mt-3">目前相片</p>
                                        <div class="row g-3">
                                            <div class="img_container">
                                                <?php
                                                // 先動態生成圖片路徑
                                                $currentImagePath = $img ? '/upload/' . $img["img"] : '';

                                                // 檢查檔案是否存在
                                                if ($img && file_exists(__DIR__ . $currentImagePath)) {
                                                    // 如果存在，使用這個路徑
                                                    echo '<img id="currentImageForm" class="img-fluid" src="' . $currentImagePath . '" alt="' . $img["img"] . '">';
                                                } else {
                                                    // 如果不存在，使用一個預設的圖片
                                                    echo '<img id="currentImageForm" class="img-fluid" src="rating/switch.png" width="200px" alt="請上傳圖片">';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <label for="release_time" class="form-label">遊戲上市時間：</label>
                                        <input type="date" class="form-control" name="release_time" id="release_time">
                                        <script>
                                            
                                            let releaseTimeInput = document.getElementById('release_time');

                                            releaseTimeInput.addEventListener('change', function() {
                                                let currentDate = new Date();
                                                var selectedDate = new Date(this.value);
                                                if (selectedDate > currentDate) {
                                                    // 如果大於目前，將輸入框的值設為現在的日期
                                                    releaseTimeInput.valueAsDate = currentDate;
                                                    alert('遊戲上市時間不能超過當前日期！');
                                                }
                                            });
                                        </script>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-check-label">語言支援：</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="CH" id="CH">
                                            <label class="form-check-label" for="CH">中文</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="EN" id="EN">
                                            <input type="checkbox" class="form-check-input" name="EN" id="EN">
                                            <input type="checkbox" class="form-check-input" name="EN" id="EN">
                                            <label class="form-check-label" for="EN">英文</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="JN" id="JN">
                                            <label class="form-check-label" for="JN">日文</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="rating_id" class="form-label">分級：</label>
                                        <select class="form-select" name="rating_id" id="rating_id">
                                            <!-- rating 資料表的選項 -->
                                            <?php foreach ($filterRating as $rating): ?>
                                                <option value="<?= $rating["id"] ?>">
                                                    <?= $rating["rating_name"] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" name="co-op_valid"
                                            id="co-op_valid" value="1">
                                        <label class="form-check-label" for="co-op_valid">支援多人</label>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <button type="submit" class="btn btn-primary">確定新增</button>
                                            <a href="product_list.php" class="btn btn-danger text-end">取消</a>
                                        </div>
                                        <button title="確定新增並繼續編輯商品詳細頁面" type="submit"
                                            class="btn btn-secondary">進階編輯</button>
                                    </div>
                                </form>
                            </div>
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
    <!-- 預覽圖片js -->
    <script>
        {/* 看有沒有改變圖片 */ }
        document.getElementById('img').addEventListener('change', function (event) {
            const selectedFile = event.target.files[0]; /* 記得要是第0個索引 */
            const currentImage = document.getElementById('currentImageForm');
            if (selectedFile) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    currentImage.src = e.target.result;
                };
                reader.readAsDataURL(selectedFile);
            } else {
                // 如果取消選擇檔案就回到一開始的圖片路徑
                const initialImagePath = '/default/path/to/image.jpg';
                currentImage.src = initialImagePath;
            }
        });
    </script>

</body>

</html>