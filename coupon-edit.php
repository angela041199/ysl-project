<?php
if (!isset($_GET["coupon_id"])) {
    header("location:coupon-list.php");
}
$id = $_GET["coupon_id"];

require_once("../ysl_project/ysldb-connect.php");

$sql = "SELECT * FROM discount_coupon WHERE coupon_id=$id AND valid =1";

$result = $conn->query($sql);
$couponCount = $result->num_rows;

$row = $result->fetch_assoc();

?>


<!doctype html>
<html lang="en">

<head>
    <title>Coupon Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php
  include("../ysl_project/ysl-css.php");
  include("../ysl_project/ysl-nav.php");
  //include("../ysl_project/sellerDashboard_sideNav.php");
  ?>
</head>

<body>
    <!-- Modal -->
    <div class="modal" tabindex="-1" id="alertModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">警告</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>是否確認刪除？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <a href="doDeleteCoupon.php?coupon_id=<?= $row["coupon_id"] ?>" class="btn btn-danger">刪除</a>
                </div>
            </div>
        </div>
    </div> <!--modal -->
    <div class="container">
        <div class="py-2">
            <a href="coupon-list.php" class="btn btn-warning" title="回到優惠券列表">回到優惠券列表</a>
        </div>
        <?php if ($couponCount == 0) : ?>
            <h1>此優惠券尚未建立</h1>
        <?php else : ?>
            <form action="doUpdateCoupon.php" method="post">
                <table class="table table-bordered">
                    <input type="hidden" name="coupon_id" value="<?= $row["coupon_id"] ?>">
                    <tr>
                        <th>優惠券名稱（限20字元內）</th>
                        <td>
                            <input type="text" class="form-control" name="title" value="<?= $row["title"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>優惠券代碼</th>
                        <td>
                            <input type="text" class="form-control" name="coupon_code" value="<?= $row["coupon_code"] ?>" disabled readonly>
                        </td>
                    </tr>
                    <tr>
                        <!-- radio怎麼寫update -->
                        <th>折扣類型</th>
                        <td>
                            <input type="radio" class="form-check-input" name="discount_type" value="percentage" required>
                            <label for="percentage" class="form-check-label">依售價百分比折價</label>
                            <input type="radio" class="form-check-input" name="discount_type" value="amount" required>
                            <label class="form-check-label" for="amount">
                                依優惠金額折價
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th>折扣百分比或折扣金額</th>
                        <td>
                            <input type="text" class="form-control" name="discount_value" value="<?= $row["discount_value"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>可使用次數</th>
                        <td>
                            <input type="text" class="form-control" name="usage_times" value="<?= $row["usage_times"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>起始日</th>
                        <td>
                            <input type="date" class="form-control" name="start_date" value="<?= $row["start_date"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>截止日</th>
                        <td>
                            <input type="date" class="form-control" name="expiration_date" value="<?= $row["expiration_date"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>使用門檻(滿多少錢可使用)</th>
                        <td>
                            <input type="text" class="form-control" name="price_rule" value="<?= $row["price_rule"] ?>">

                        </td>
                    </tr>
                    <tr>
                        <th>可使用的範圍</th>
                        <td>
                            <select class="form-select" aria-label="applicable_scope" name="applicable_scope" required>
                                <option selected>請選擇優惠券使用範圍</option>
                                <option value="global">全站</option>
                                <option value="type">依類別</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>使用類別</th>
                        <td>
                            <select class="form-select" aria-label="applicable_type_id" name="applicable_type_id">
                                <option selected>請選擇優惠券使用類別</option>
                                <option value="0">全站使用</option>
                                <option value="1">RPG</option>
                                <option value="2">AVG</option>
                                <option value="3">ETC</option>
                                <option value="4">ACT</option>
                                <option value="5">SLG</option>
                                <option value="6">ARPG</option>
                                <option value="7">SRPG</option>
                                <option value="8">RAC</option>
                                <option value="9">SPG</option>
                                <option value="10">STG</option>
                                <option value="11">AAPG</option>
                                <option value="12">FTG</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>優惠券狀態</th>
                        <td>
                            <input class="form-check-input" type="radio" name="status" id="status_1" value="1" required>
                            <label class="form-check-label" for="status_1">
                                可使用
                            </label>
                            <input class="form-check-input" type="radio" name="status" id="status_0" value="0" required>
                            <label class="form-check-label" for="status_0">
                                未啟用
                            </label>
                        </td>
                    </tr>
                </table>
                <div class="d-flex justify-content-between">
                    <div class="py-2">
                        <button class="btn btn-warning" type="submit">儲存</button>
                        <a href="coupon.php?coupon_id=<?= $row["coupon_id"] ?>" class="btn btn-outline-secondary">取消</a>
                    </div>
                    <!-- 新增刪除按鈕 -->
                    <div>
                        <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#alertModal">刪除</button>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>