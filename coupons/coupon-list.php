<?php
require_once("../includes/connect_sever.php");

// 製作分頁
$sqlTotal = "SELECT * FROM discount_coupon WHERE valid=1";
$resultTotal = $conn->query($sqlTotal);
$totalCoupon = $resultTotal->num_rows;
$perPage = 6;
$pageCount = ceil($totalCoupon / $perPage);

if (isset($_GET["search"])) {
  $search = $_GET["search"];
  $sql = "SELECT * FROM discount_coupon WHERE title LIKE '%$search%' AND valid=1";
} elseif (isset($_GET["page"]) && isset($_GET["order"])) {
  $page = $_GET["page"];
  $order = $_GET["order"];
  switch ($order) {
    case 1:
      $orderSql = "coupon_id ASC";
      break;
    case 2:
      $orderSql = "coupon_id DESC";
      break;
    case 3:
      $orderSql = "start_date ASC";
      break;
    case 4:
      $orderSql = "start_date DESC";
      break;
    default:
      $orderSql = "coupon_id ASC";
  }
  $startItem = ($page - 1) * $perPage;

  //JOIN資料表選取：
  //SELECT discount_coupon.*, type.* FROM discount_coupon JOIN type on discount_coupon.applicable_type_id = type.id;

  $sql = "SELECT * FROM discount_coupon WHERE valid=1 ORDER BY $orderSql LIMIT $startItem, $perPage";
} else {
  $page = 1;
  $order = 1;
  $sql = "SELECT * FROM discount_coupon WHERE valid =1 ORDER BY coupon_id ASC LIMIT 0, $perPage";
}
$result = $conn->query($sql);

$sqlType = "SELECT * FROM type WHERE valid = 1";
$resultType = $conn->query($sqlType);
$rowsType = $resultType->fetch_all(MYSQLI_ASSOC);

//var_dump($rowsType[0]["name"]);
//exit;
?>


<!doctype html>
<html lang="en">

<head>
  <title>Coupon list</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php
  include("../coupons/ysl-css.php");
  include("../style/admin-nav.php");


  // include("../ysl_project/sellerDashboard_sideNav.php");

  ?>
  <style>
    .custom-table{
      border-radius: 20px;
      overflow: hidden;
    }
  </style>

</head>

<body class="sb-nav-fixed">
  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <?php include("../style/admin_dashboard.php"); ?>
      <main>
        <div class="container-fluid px-4">
          <ol class="breadcrumb mb-4  mt-3">
            <li class="breadcrumb-item"><a href="../style/admin_index.php">首頁</a></li>
            <li class="breadcrumb-item"><a href="coupon-list.php">行銷管理</a></li>            
            <li class="breadcrumb-item active">優惠券列表</li>
          </ol>
          <?php
          $couponCount = $result->num_rows;
          ?>
          <div class="py-2 d-flex justify-content-between align-items-center">
            <div class="card mb-1">
              <div class="card-body">
                <?php
                if (isset($_GET["search"])) : ?>
                  <a href="coupon-list.php" class="btn btn-primary" title="回到優惠券列表"><i class="fa-solid fa-arrow-left"></i></a>
                  搜尋<?= $_GET["search"] ?>的結果，<?php endif; ?>
                  目前顯示<?= $couponCount ?>張優惠券（共有<?= $totalCoupon ?>張優惠券）
                  <a href="add-coupon.php" class="btn btn-warning ms-3" title="新增優惠券"><i class="fa-solid fa-plus pe-1"></i>新增優惠券</a>
              </div>
            </div>
          </div>
          <div class="py-2 row">
            <div class="col-5">
              <form action="">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="搜尋優惠券名稱..." name="search">
                  <button class="btn btn-warning" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
              </form>
            </div>
          </div>

          <?php if (!isset($_GET["search"])) : ?>
            <div class="py-2 d-flex justify-content-end">
              <div class="btn-group">
                <!-- coupon id ASC -->
                <a class="btn btn-primary <?php if ($order == 1) echo "active" ?>" href="coupon-list.php?page=<?= $page ?>&order=1"><i class="fa-solid fa-arrow-up-wide-short pe-1"></i>編號(由小到大)</a>
                <!-- coupon id DESC -->
                <a class="btn btn-primary <?php if ($order == 2) echo "active" ?>" href="coupon-list.php?page=<?= $page ?>&order=2"><i class="fa-solid fa-arrow-down-wide-short pe-1"></i>編號(由大到小)</a>
                <!-- start date ASC -->
                <a class="btn btn-primary <?php if ($order == 3) echo "active" ?>" href="coupon-list.php?page=<?= $page ?>&order=3"><i class="fa-solid fa-arrow-trend-up pe-1"></i>起始日期(由近到遠)</a>
                <!-- start date DESC -->
                <a class="btn btn-primary <?php if ($order == 4) echo "active" ?>" href="coupon-list.php?page=<?= $page ?>&order=4"><i class="fa-solid fa-arrow-trend-down pe-1"></i>起始日期(由遠到近)</a>
              </div>
            </div>
          <?php endif; ?>

          <div>
            <?php
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            //var_dump($rows);
            ?>
          </div>
          <?php if ($couponCount > 0) : ?>
            <table class="custom-table table table-bordered table-striped table-hover border-white align-middle">
              <thead class="table-warning border-white">
                <tr>
                  <th class="text-nowrap">編號</th>
                  <th class="text-nowrap">優惠券<br>名稱</th>
                  <th class="text-nowrap">優惠券<br>代碼</th>
                  <th class="text-nowrap">折扣<br>類型</th>
                  <th class="text-nowrap">折扣百分比(%)<br>或優惠金額</th>
                  <th class="text-nowrap">可使用<br>次數</th>
                  <th class="text-nowrap">起始日</th>
                  <th class="text-nowrap">截止日</th>
                  <th class="text-nowrap">使用門檻<br><span class="small text-secondary text-nowrap">(滿多少錢可使用)</span></th>
                  <th class="text-nowrap">使用<br>範圍</th>
                  <th class="text-nowrap">使用<br>類別</th>
                  <th class="text-nowrap">創立<br>日期</th>
                  <th class="text-nowrap">優惠券<br>狀態</th>
                  <th>詳細<br>資訊</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rows as $row) : ?>

                  <tr>
                    <?php
                    $discountType = $row["discount_type"];
                    switch ($discountType) {
                      case 'percentage':
                        $displaydiscountType = '百分比折價';
                        break;
                      case 'amount':
                        $displaydiscountType = '優惠金額折價';
                        break;
                    }
                    $startDateText = $row["start_date"];
                    switch ($startDateText) {
                      case 'user_created_at':
                        $displaystartDate = '使用者註冊帳號時間';
                        break;
                      default:
                        $displaystartDate = $startDateText;
                        break;
                    }
                    $expirationDateText = $row["expiration_date"];
                    switch ($expirationDateText) {
                      case 'no-expire':
                        $displayExpirationDate = '無使用期限';
                        break;
                      default:
                        $displayExpirationDate = $expirationDateText;
                        break;
                    }
                    $applicableScope = $row["applicable_scope"];
                    switch ($applicableScope) {
                      case 'global':
                        $displayapplicableScope = '全站使用';
                        break;
                      case 'type':
                        $displayapplicableScope = '依商品類別使用';
                        break;
                    }
                    $couponStatus = $row["status"];
                    switch ($couponStatus) {
                      case '1':
                        $displaycouponStatus = '可使用';
                        break;
                      case '0':
                        $displaycouponStatus = '未啟用';
                        break;
                    }
                    ?>
                    <td><?= $row["coupon_id"] ?></td>
                    <td><?= $row["title"] ?></td>
                    <td><?= $row["coupon_code"] ?></td>
                    <td><?= $displaydiscountType ?></td>
                    <td><?= $row["discount_value"]?></td>
                    <td><?= $row["usage_times"] ?>次</td>
                    <td><?= $displaystartDate ?></td>
                    <td><?= $displayExpirationDate ?></td>
                    <td><?= $row["price_rule"] ?></td>
                    <td><?= $displayapplicableScope ?></td>
                    <td><?php
                        $applicableTypeId = $row['applicable_type_id'];
                        $typeName = '';
                        foreach ($rowsType as $type) {
                          if ($type['id'] == $applicableTypeId) {
                            $typeName = $type['name'];
                            break;
                          }
                        }
                        echo $typeName;
                        ?> </td>
                    <td><?= $row["created_at"] ?></td>
                    <td><?= $displaycouponStatus ?></td>
                    <td>
                      <a class="btn btn-warning" href="coupon.php?coupon_id=<?= $row["coupon_id"] ?>" title="Detail information"><i class="fa-solid fa-circle-info"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <?php if (!isset($_GET["search"])) : ?>
              <div class="py-2">
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                      <li class="page-item
                        <?php
                        if ($page == $i) echo "active"; ?>"><a class="page-link" href="coupon-list.php?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                  </ul>
                </nav>
              </div>
            <?php endif; ?>
          <?php else : ?>
            尚未建立與“<?= $search ?>”相關名稱之優惠券
          <?php endif; ?>
        </div><!--container -->
      </main>
      <footer class="py-4 bg-light mt-auto">
        <?php include("../style/footer.php"); ?>
      </footer>
    </div>

  </div>



  <!-- Bootstrap JavaScript Libraries -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
  </script> -->
</body>

</html>