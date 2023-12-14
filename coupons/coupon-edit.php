<?php
if (!isset($_GET["coupon_id"])) {
    header("location:coupon-list.php");
}
$id = $_GET["coupon_id"];

require_once("../includes/connect_sever.php");

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
    include("../coupons/ysl-css.php");
    include("../style/admin-nav.php");
    include("../style/side-nav-js.php");
    //include("../ysl_project/sellerDashboard_sideNav.php");
    ?>
    <style>
        .input-error {
            color: red;
        }
    </style>
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

    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <?php include("../style/admin_dashboard.php"); ?>
                <main>
                    <div class="container">
                        <div class="py-2">
                            <a href="coupon-list.php" class="btn btn-warning" title="回到優惠券列表">回到優惠券列表</a>
                        </div>
                        <?php if ($couponCount == 0) : ?>
                            <h1>此優惠券尚未建立</h1>
                        <?php else : ?>
                            <form action="doUpdateCoupon.php" method="post" id="updateCouponform" onsubmit="return validateForm()">
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
                                            <input type="radio" class="form-check-input" name="discount_type" value="percentage" <?php
                                                                                                                                    if ($row["discount_type"] == 'percentage') echo "checked"
                                                                                                                                    ?> required>
                                            <label for="percentage" class="form-check-label">依售價百分比折價</label>
                                            <input type="radio" class="form-check-input" name="discount_type" value="amount" <?php
                                                                                                                                if ($row["discount_type"] == 'amount') echo "checked"
                                                                                                                                ?> required>
                                            <label class="form-check-label" for="amount">
                                                依優惠金額折價
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>折扣百分比或折扣金額</th>
                                        <td>
                                            <input type="text" class="form-control" name="discount_value" id="discount_value" value="<?= $row["discount_value"] ?>">
                                            <span id="discountValueError" class="input-error"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>可使用次數</th>
                                        <td>
                                            <input type="text" class="form-control" name="usage_times" id="usage_times" value="<?= $row["usage_times"] ?>" oninput="validateNumberInput(this)">
                                            <span id="usage_timesError" class="input-error"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>起始日</th>
                                        <td>
                                            <?php if ($row["start_date"] == "user_created_at") echo "hidden" ?>
                                            <input type="date" class="form-control" name="start_date" id="start_date" value="<?= $row["start_date"] ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>截止日</th>
                                        <td>
                                            <input type="date" class="form-control" name="expiration_date" id="expiration_date" value="<?= $row["expiration_date"] ?>">
                                            <span id="dateError" class="input-error pt-1"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>使用門檻(滿多少錢可使用)</th>
                                        <td>
                                            <input type="text" class="form-control" name="price_rule" id="price_rule" value="<?= $row["price_rule"] ?>" oninput="validateNumberInput(this)">
                                            <span id="price_ruleError" class="input-error"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>可使用的範圍</th>
                                        <td>
                                            <select class="form-select" aria-label="applicable_scope" name="applicable_scope" required>
                                                <option selected>請選擇優惠券使用範圍</option>
                                                <option value="global" <?php
                                                                        if ($row["applicable_scope"] == 'global') echo "selected"
                                                                        ?>>全站</option>
                                                <option value="type" <?php
                                                                        if ($row["applicable_scope"] == 'type') echo "selected"
                                                                        ?>>依類別</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>使用類別</th>
                                        <td>
                                            <select class="form-select" aria-label="applicable_type_id" name="applicable_type_id">
                                                <option selected>請選擇優惠券使用類別</option>
                                                <option value="0" <?php
                                                                    if ($row["applicable_scope"] == 'global') echo "selected"
                                                                    ?>>全站使用</option>
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
                                            <input class="form-check-input" type="radio" name="status" id="status_1" value="1" <?php if ($row["status"] == 1) echo "checked" ?> required>
                                            <label class="form-check-label" for="status_1">
                                                可使用
                                            </label>
                                            <input class="form-check-input" type="radio" name="status" id="status_0" value="0" <?php if ($row["status"] == 0) echo "checked" ?> required>
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
                </main>
                <footer class="py-4 bg-light mt-auto">
                <?php include("../style/footer.php");?>
                </footer>
            </div>

        </div>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <!-- 驗證截止日期不會早於開始日期 -->
        <script>
            function validateDate() {
                //獲得開始日期和截止日期的值
                let startDate = document.getElementById('start_date').value;
                let expirationDate = document.getElementById('expiration_date').value;
                //把日期字串轉換成date
                let startDateObj = new Date(startDate);
                let expirationDateObj = new Date(expirationDate);
                //清空日期錯誤訊息
                document.getElementById('dateError').innerHTML = '';
                //驗證截止日期是否早於開始日期
                if (expirationDateObj < startDateObj) {
                    //顯示錯誤
                    document.getElementById('dateError').innerHTML = '優惠券截止日期不可以早於開始日期';
                    return false;
                } else {
                    return true;
                }
            }
        </script>
        <!-- 驗證input -->
        <script>
            function validateNumberInput(inputElement) {
                let inputValue = inputElement.value.trim();
                let errorElementId = inputElement.id + 'Error';
                //清空錯誤訊息
                document.getElementById(errorElementId).innerHTML = '';

                //驗證是否為數字
                if (!/^\d+$/.test(inputValue)) {
                    document.getElementById(errorElementId).innerHTML = '請輸入數字';
                }
            }

            function clearErrors() {
                //清空所有錯誤訊息
                let errorElements = document.getElementsByClassName('input-error');
                for (let i = 0; i < errorElements.length; i++) {
                    errorElements[i].innerHTML = '';
                }
            }

            function validateDiscountValue() {
                let discountType = document.querySelector('input[name="discount_type"]:checked').value;
                let discountValueInput = document.getElementById('discount_value');
                let discountValue = discountValueInput.value.trim();
                //驗證discount_value是否為數字
                if (!/^\d+$/.test(discountValue)) {
                    document.getElementById('discountValueError').innerHTML = '請輸入數字';
                    return false;
                }
                //優惠券類型為百分比時，驗證discount_value
                if (discountType === 'percentage') {
                    discountValue = parseInt(discountValue);
                    //驗證discount_value範圍        
                    if (isNaN(discountValue) || discountValue < 0 || discountValue > 100) {
                        document.getElementById('discountValueError').innerHTML = '請輸入有效的百分比（0-100）';
                        return false;
                    }
                }
                return true;
            }

            function validateForm() {
                clearErrors();
                //檢查可使用次數是否為數字
                validateNumberInput(document.getElementById('usage_times'));
                //檢查最低消費金額是否為數字
                validateNumberInput(document.getElementById('price_rule'));
                //日期驗證
                let isDateValid = validateDate();
                if (!validateDiscountValue()) {
                    return false;
                }
                //全部都通過：返回true
                return isDateValid;
            }
        </script>
    </body>

</html>