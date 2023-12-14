<?php
require_once("../includes/connect_sever.php");
include("../style/admin-nav.php");
include("../style/admin_dashboard.php");
include("../style/side-nav-js.php");


// $id = $_GET["id"];


$sql = "SELECT id, name, account, phone, email, created_at, valid, member_identity FROM ysl_member WHERE valid = 1";

$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
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
                        <li class="breadcrumb-item"><a href="../style/admin_index.php">首頁</a></a></li>
                        <li class="breadcrumb-item"><a href="#">會員管理</a></a></li>
                        <li class="breadcrumb-item active">會員資料</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            歡迎來到 YSL 的會員後台，您的專屬空間。我們為您提供了一個有效的工具，以確保每一位會員都能享受到尊榮的購物體驗。

                        </div>

                    </div>
                    <div>
                        <form action="">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="尋找會員..." name="search">
                                <button class="btn btn-secondary" type="submit" id=""><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            會員資料表
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="p-1">id</th>
                                        <th class="p-2">姓名</th>
                                        <th class="p-2">帳號</th>
                                        <th class="p-1 pe-3">電話</th>
                                        <th class="p-2">Email</th>
                                        <th class="p-2">加入會員時間</th>
                                        <th class="p-2">會員狀態</th>
                                        <th>冷凍狀況</th>


                                    </tr>
                                </thead>
                                <!-- <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot> -->
                                <tbody>
                                    <?php foreach ($rows as $row) : ?>
                                        <tr>

                                            <td class="p-1"><?= $row["id"] ?></td>

                                            <td class="p-2"><?= $row["name"] ?></td>
                                            <td class="p-2"><?= $row["account"] ?></td>
                                            <td class="p-1 pe-3"><?= $row["phone"] ?></td>
                                            <td class="p-2"><?= $row["email"] ?></td>
                                            <td class="p-2"><?= $row["created_at"] ?></td>
                                            <td class="p-2 text-center">
                                                <!-- <div class="d-flex justify-content-center align-items-center"> -->
                                                    <a href="memberProfile.php?id=<?= $row["id"] ?>">
                                                        <button class="btn btn-secondary" >
                                                            <?php
                                                            if ($row["valid"] == 1) {
                                                                echo "正常";
                                                            } else {
                                                                echo "暫停";
                                                            }

                                                            ?>
                                                        </button>
                                                    </a>
                                                <!-- </div> -->
                                            </td>
                                            <td>
                                                <form action="doDelete.php" method="POST">
                                                    <input type="hidden" name="id" value="<?= $row["id"]; ?>">
                                                    <input type="hidden" name="name" value="<?= $row["name"]; ?>">

                                                    <button class="btn btn-secondary " data-bs-toggle="modal" data-bs-target="#alertModal<?= $row["id"] ?>" type="button">冷凍</button>

                                                    <div class="modal fade" id="alertModal<?= $row["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">注意</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    確定冷凍<?= $row["name"] ?>嗎？
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                                    <a href="doDelete.php?id=<?= $row["id"] ?>"><button type=submit class="btn btn-primary">確認</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">

                <?php include("../style/footer.php"); ?>
            </footer>
        </div>



    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>