<?php

if (!isset($_GET["id"])) {
    header("location: member-admin.php");
}

$id = $_GET["id"];


require_once("../includes/connect_sever.php");
include("../style/admin-nav.php");
include("../style/admin_dashboard.php");



$sql = "SELECT * FROM ysl_member WHERE valid IN (0, 1) AND id='$id'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$userCount = $result->num_rows;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>member-admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>


    <?php include("../includes/css_link.php") ?>

</head>

<body class="sb-nav-fixed">

    <div id="layoutSidenav">

        <div id="layoutSidenav_content">
            <main>
                
                    <div class="container-fluid px-4">

                        <ol class="breadcrumb mb-4  mt-3">
                            <li class="breadcrumb-item"><a href="index.php">YSL後台</a></li>
                            <li class="breadcrumb-item active">會員管理</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                歡迎來到 YSL 的會員後台，您的專屬空間。我們為您提供了一個有效的工具，以確保每一位會員都能享受到尊榮的購物體驗。

                            </div>

                        </div>

                        <div class="card mb-4 mt-2">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                <?= $row["name"] ?>會員資料表
                            </div>
                            <div class="card-body">
                                <?php if ($userCount == 0) : ?>
                                    <H1>會員不存在</H1>
                                <?php else : ?>
                                    <form action="doEdit.php" method="post">
                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                        <table class="table table-bordered mt-4">

                                            <tr>
                                                <th>姓名</th>
                                                <td><input type="text" class="form-control" name="name" value="<?= $row["name"] ?>"></td>
                                            </tr>
                                            <tr>
                                                <th>信箱</th>
                                                <td><input type="email" class="form-control" name="email" value="<?= $row["email"] ?>"></td>
                                            </tr>
                                            <tr>
                                                <th>手機</th>
                                                <td><input type="tel" class="form-control" name="phone" value="<?= $row["phone"] ?>"></td>
                                            </tr>


                                            <tr>
                                                <th>生日</th>
                                                <td><input type="date" class="form-control" name="birthday" value="<?= $row["birthday"] ?>"></td>
                                            </tr>
                                            <tr>
                                                <th>生理性別</th>
                                                <td>
                                                    <input type="radio" id="gender_f" name="gender" value="Female" <?php echo ($row["gender"] == "Female") ? "checked" : ""; ?>>
                                                    <label for="gender_f">女</label>

                                                    <input type="radio" id="gender_m" name="gender" value="Male" <?php echo ($row["gender"] == "Male") ? "checked" : ""; ?>>
                                                    <label for="gender_m">男</label>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>地址</th>
                                                <td><input type="address" class="form-control" name="address" value="<?= $row["address"] ?>"></td>
                                            </tr>

                                            <div class="mt-1">
                                                <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-floppy-disk me-1"></i>儲存</button>
                                                <a href="memberProfile.php?id=<?= $row["id"] ?>" class="btn btn-secondary text-white" title="修改資料"><i class="fa-solid fa-xmark me-1"></i>取消</a>
                                            </div>

                                        </table>
                                    </form>
                                <?php endif; ?>
                            </div>

                        </div>





                        <!-- <a href="doEdit.php">
                            <button type="submit" class="btn btn-secondary me-3">編輯</button>
                        </a> -->
                        <!-- <span class="text-secondary">已有帳號了嗎?</span> -->

                        <!-- <a href="admin-login.php" class="" type="">登入</a> -->

                    </div>
                </form>
            </main>



            <footer class="py-4 bg-light mt-auto">

                <?php include("../style/footer.php") ?>
            </footer>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>