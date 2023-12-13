<?php
if (!isset($_GET["coupon_id"])) {
    header("location: coupon-list.php");
}

$id = $_GET["coupon_id"];

require_once("../ysl_project/ysldb-connect.php");

$sql = "SELECT * FROM discount_coupon WHERE coupon_id = $id AND valid =1";

$result = $conn->query($sql);
$couponCount = $result->num_rows;
$row = $result->fetch_assoc();

//類別SQL
$sqlType = "SELECT * FROM type WHERE valid = 1";
$resultType = $conn->query($sqlType);
$rowsType = $resultType->fetch_all(MYSQLI_ASSOC);

//連結member_coupon
$sqlMemberCoupon = "SELECT member_coupon.*, ysl_member.* FROM member_coupon JOIN ysl_member on member_coupon.member_id = ysl_member.id
WHERE member_coupon.coupon_id = $id";
$resultMemberCoupon = $conn->query($sqlMemberCoupon);
$rowsMemberCoupon = $resultMemberCoupon->fetch_all(MYSQLI_ASSOC);
?>
<pre>
    <?php //print_r($rowsMemberCoupon); 
    //exit;
    ?>
</pre>

<!doctype html>
<html lang="en">

<head>
    <title>Coupon</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php
    include("../ysl_project/ysl-css.php");
    include("../231215-YSL-project/admin-nav.php");
    ?>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <?php include("../231215-YSL-project/admin_dashboard.php"); ?>
            <main>
                <div class="container">
                    <div class="py-2">
                        <a href="coupon-list.php" class="btn btn-warning" title="回到優惠券一覽列表"><i class="fa-solid fa-arrow-left"></i></a>
                    </div>
                    <?php if ($couponCount == 0) : ?>
                        <h1>找不到此優惠券</h1>
                    <?php else : ?>
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
                        $applicableScope = $row["applicable_scope"];
                        switch ($applicableScope) {
                            case 'global':
                                $displayapplicableScope = '全站使用';
                                break;
                            case 'type':
                                $displayapplicableScope = '依類別使用';
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
                        <table class="table table-bordered">
                            <tr>
                                <th>編號</th>
                                <td><?= $row["coupon_id"] ?></td>
                            </tr>
                            <tr>
                                <th>優惠券名稱</th>
                                <td><?= $row["title"] ?></td>
                            </tr>
                            <tr>
                                <th>優惠券代碼</th>
                                <td><?= $row["coupon_code"] ?></td>
                            </tr>
                            <tr>
                                <th>折扣類型</th>
                                <td><?= $displaydiscountType ?></td>
                            </tr>
                            <tr>
                                <th>折扣百分比或折扣金額</th>
                                <td><?= $row["discount_value"] ?></td>
                            </tr>
                            <tr>
                                <th>可使用次數</th>
                                <td><?= $row["usage_times"] ?></td>
                            </tr>
                            <tr>
                                <th>起始日</th>
                                <td><?= $displaystartDate ?></td>
                            </tr>
                            <tr>
                                <th>截止日</th>
                                <td><?= $row["expiration_date"] ?></td>
                            </tr>
                            <tr>
                                <th>使用門檻(滿多少錢可使用)</th>
                                <td><?= $row["price_rule"] ?></td>
                            </tr>
                            <tr>
                                <th>可使用的範圍</th>
                                <td><?= $displayapplicableScope ?></td>
                            </tr>
                            <tr>
                                <th>使用類別</th>
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
                            </tr>
                            <tr>
                                <th>創立日期</th>
                                <td><?= $row["created_at"] ?></td>
                            </tr>
                            <tr>
                                <th>優惠券狀態</th>
                                <td><?= $row["status"] ?></td>
                            </tr>
                        </table>
                        <div class="pb-2">
                            <a href="coupon-edit.php?coupon_id=<?= $row["coupon_id"] ?>" class="btn btn-warning" title="編輯優惠券"><i class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                    <?php endif; ?>
                    <?php
                    $MemberCouponCount = $resultMemberCoupon->num_rows; ?>
                    <h2 class="fw-bold my-3">擁有這張優惠券的使用者（共<?= $MemberCouponCount ?>人）</h2>
                    <!--如果有使用者有這張優惠券才顯示-->
                    <?php
                    if ($MemberCouponCount > 0) : ?>
                        <div class="row g-3">
                            <?php foreach ($rowsMemberCoupon as $row) : ?>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                    <h3><?= $row["name"] ?></h3>
                                    <?= $row["account"] ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        使用者尚未擁有此張優惠券
                    <?php endif; ?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <?php include("../231215-YSL-project/footer.php"); ?>
            </footer>
        </div>

    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>