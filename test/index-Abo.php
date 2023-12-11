<?php
require_once("../connect_server.php");
//活動分類資料庫
$eventCategory = "SELECT * FROM event_category";
$resultCategory = $conn->query($eventCategory);
$rowsCategory = $resultCategory->fetch_all(MYSQLI_ASSOC);
//--------------------------------------------------------//
//計算頁數
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == 1) {
        $sql = "SELECT * FROM user_order WHERE valid = 1";
    } else if ($status == 0) {
        $sql = "SELECT * FROM user_order WHERE valid = 0";
    } else if ($status == 3) {
        $sql = "SELECT * FROM user_order WHERE valid IN (1, 0)";
    }
} else {
    $sql = "SELECT * FROM user_order";
}
$resultCount = $conn->query($sql);
$AllresultCount = $resultCount->num_rows;
$perPage = 4;
$pages = ceil($AllresultCount / $perPage);
//--------------------------------------------------------//
if (isset($_GET['status']) || isset($_GET['page'])) {
    // 檢查訂單是否取消
    $status = $_GET["status"];
    $page = $_GET['page'];
    $startItem = ($page - 1) * $perPage;

    // 獲取 status=1 和 status=0 的資料
    if ($status == 3) {
        $sql = "SELECT user_order.*, campaign.*, ticket.qr_code, user.user_name, event_category.event_name
        FROM user_order 
        JOIN campaign ON campaign.id = user_order.event_id
        JOIN ticket ON ticket.id = user_order.ticket_number
        JOIN user ON user.id = user_order.user_id
        JOIN event_category ON event_category.id = campaign.event_type_id
        WHERE user_order.valid IN (1, 0)
        ORDER BY campaign.start_date ASC 
        LIMIT $startItem, $perPage";
    } else {
        $sql = "SELECT user_order.*, campaign.*, ticket.qr_code, user.user_name, event_category.event_name
        FROM user_order 
        JOIN campaign ON campaign.id = user_order.event_id
        JOIN ticket ON ticket.id = user_order.ticket_number
        JOIN user ON user.id = user_order.user_id
        JOIN event_category ON event_category.id = campaign.event_type_id
        WHERE user_order.valid = $status
        ORDER BY campaign.start_date ASC 
        LIMIT $startItem, $perPage";
    }

    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // 預設情況
    $status = 1;
    $page = 1;
    // 訂單資料庫串聯
    $sql = "SELECT user_order.*, campaign.*, ticket.qr_code, user.user_name, event_category.event_name
    FROM user_order
    JOIN campaign ON campaign.id = user_order.event_id
    JOIN ticket ON ticket.id = user_order.ticket_number
    JOIN user ON user.id = user_order.user_id
    JOIN event_category ON event_category.id = campaign.event_type_id
    ORDER BY campaign.start_date ASC
    LIMIT 0, $perPage";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
}




?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>訂單資訊</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap icon link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <!-- 字體連結 -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../Template/css/govent.css" rel="stylesheet" />
    <link rel="stylesheet" href="./style.css" />
</head>

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-ticket"></i>
                </div>
                <div class="sidebar-brand-text mx-3">GoVent</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="../image/1.png" alt="..." />
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link text-shadow-20" href="index.html">
                    <i class="bi bi-speedometer"></i>
                    <span>平台管理</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">Interface</div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed text-shadow-20" href="#" data-toggle="collapse" data-target="#collapseMember" aria-expanded="true" aria-controls="collapseMember">
                    <i class="bi bi-people-fill"></i>
                    <span>會員管理</span>
                </a>
                <div id="collapseMember" class="collapse" aria-labelledby="headingMember" data-parent="#accordionSidebar">
                    <div class="bg-white-transparency py-2 collapse-inner rounded text-shadow-20">
                        <h6 class="collapse-header">Member Management</h6>
                        <a class="collapse-item" href="#">會員清單</a>
                        <a class="collapse-item" href="#">會員註冊（客戶端）</a>
                        <a class="collapse-item" href="#">會員登入（客戶端）</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed text-shadow-20" href="#" data-toggle="collapse" data-target="#collapseOrganizer" aria-expanded="true" aria-controls="collapseOrganizer">
                    <i class="bi bi-building-fill"></i>
                    <span>主辦單位管理</span>
                </a>
                <div id="collapseOrganizer" class="collapse" aria-labelledby="headingOrganizer" data-parent="#accordionSidebar">
                    <div class="bg-white-transparency py-2 collapse-inner rounded text-shadow-20">
                        <h6 class="collapse-header">Orangizer Management</h6>
                        <a class="collapse-item" href="#">主辦單位清單</a>
                        <a class="collapse-item" href="#">修改／新增</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed text-shadow-20" href="#" data-toggle="collapse" data-target="#collapseEvent" aria-expanded="true" aria-controls="collapseEvent">
                    <i class="bi bi-calendar-event-fill"></i>
                    <span>活動管理</span>
                </a>
                <div id="collapseEvent" class="collapse" aria-labelledby="headingEvent" data-parent="#accordionSidebar">
                    <div class="bg-white-transparency py-2 collapse-inner rounded text-shadow-20">
                        <h6 class="collapse-header">Event Management</h6>
                        <a class="collapse-item" href="#">活動清單</a>
                        <a class="collapse-item" href="#">票卷管理</a>
                    </div>
                </div>
            </li>
            <li class="nav-item text-shadow-20">
                <a class="nav-link" href="">
                    <i class="bi bi-border-width"></i>
                    <span>訂單管理</span></a>
            </li>
            <li class="nav-item text-shadow-20">
                <a class="nav-link" href="">
                    <i class="bi bi-ticket-fill"></i>
                    <span>優惠卷管理</span></a>
            </li>
            <!-- Divider -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block" />

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa-solid fa-bars" style="color: #fd7e14"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-3 d-none d-lg-inline text-gray-600 x-small">平台管理員</span>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">妙蛙種子</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                      Profile
                                  </a>
                                  <a class="dropdown-item" href="#">
                                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                      Settings
                                  </a>
                                  <a class="dropdown-item" href="#">
                                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                      Activity Log
                                  </a>
                                  <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    登出
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">訂單資訊</h1>
                    <!-- 訂單資訊選項 -->

                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a href="index-Abo.php?status=<?= 3 ?>&page=<?= $page ?>">
                            <button type="button" class="btn btn-outline-primary">
                                全部
                            </button>
                        </a>
                        <a href="index-Abo.php?status=<?= 1 ?>&page=<?= $page ?>"><button type="button" class="btn btn-outline-primary">
                                已下單
                            </button></a>
                        <a href="index-Abo.php?status=<?= 0 ?>&page=<?= $page ?>"><button type="button" class="btn btn-outline-primary">
                                已取消
                            </button></a>

                    </div>

                    <!-- 頁數 -->
                    <nav aria-label="Page navigation example ">
                        <ul class="pagination justify-content-center">
                            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                <li class="page-item"><a class="page-link" href="index-Abo.php?status=<?= $status ?>&page=<?= $i ?>"><?= $i ?></a></li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                    <!-- 訂單內容 -->
                    <div class="container my-3">
                        <?php foreach ($rows as  $row) : ?>
                            <div class="row">
                                <div class="col-12 card card-body py-3 border-left-primary">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="left">
                                            <div class="title py-1">
                                                <?= $row["event_name"] ?>
                                            </div>
                                            <div class="time py-1">
                                                <?= $row["start_date"] ?> ~ <?= $row["end_date"] ?>
                                            </div>
                                            <div class="number py-1">票券號碼 ： <?= $row["qr_code"] ?></div>
                                        </div>
                                        <div class="right">
                                            <p class="d-inline-flex gap-1">
                                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample<?= $row["id"] ?>" aria-expanded="false" aria-controls="collapseExample<?= $row["id"] ?>">
                                                    票券資訊
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse col-12 p-0" id="collapseExample<?= $row["id"] ?>">
                                    <div class="card card-body">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>票號</th>
                                                    <th>參加人</th>
                                                    <th>票種</th>
                                                    <th>單價</th>
                                                    <th>有效期限</th>
                                                    <th>狀態</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?= $row["qr_code"] ?></td>
                                                    <td><?= $row["user_name"] ?></td>
                                                    <td><?= $row["event_name"] ?></td>
                                                    <td><?= $row["event-price"] ?></td>
                                                    <td>
                                                        <?= $row["start_date"] ?> ~<br /> <?= $row["end_date"] ?>
                                                    </td>
                                                    <td><?php
                                                        if ($row["valid"] == 1) {
                                                            echo "已下單";
                                                        } else if ($row["valid"] == 0) {
                                                            echo "取消訂單";
                                                        } else {
                                                            echo "未下單";
                                                        }
                                                        ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; GOVENT 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./js/govent.js"></script>

    <!-- Page level plugins -->
    <script src="./vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="./js/demo/chart-area-demo.js"></script>
    <script src="./js/demo/chart-pie-demo.js"></script>
</body>

</html>