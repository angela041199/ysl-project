<?php

if (!isset($_GET["id"])) {
    header("location: member-admin.php");
}

$id = $_GET["id"];


require_once("../connect_server.php");



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


    <?php include("../css_link.php") ?>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">YSL後台</a>
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
                    <li><a class="dropdown-item" href="#!">設定</a></li>
                    <!-- <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li> -->
                    <li><a class="dropdown-item" href="admin-login.php">登出</a></li>
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
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            YSL後台
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>


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
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link collapsed" href="member-admin.php" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            會員管理

                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">

                                <a class="nav-link" href="member-admin.php">會員資料</a>

                                <a class="nav-link" href="memberAdd.php">新增會員</a>

                                <a class="nav-link" href="member-deleted-list.php">被冷凍的會員</a>
                            </nav>
                        </div>






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
                            會員資料表
                        </div>
                        <div class="card-body">
                            <?php if ($userCount == 0) : ?>
                                <H1>會員不存在</H1>
                            <?php else : ?>
                                <form action="doEdit.php" method="post">
                                    <input type="hidden" name="id" value="<?=$row["id"]?>">
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
                                                <input type="radio" id="gender_f" name="gender" value="female">
                                                <label for="gender_f">女</label><br>
                                                <input type="radio" id="gender_m" name="gender" value="male">
                                                <label for="gender_m">男</label><br>
                                                <input type="hidden" value="Submit">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>地址</th>
                                            <td><input type="address" class="form-control" name="address" value=""></td>
                                        </tr>
                                        
                                        <div class="mt-1">
                                            <button class="btn btn-secondary">儲存</button>
                                            <a href="memberProfile.php?id=<?= $row["id"] ?>" class="btn btn-secondary text-white" title="修改資料">取消</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>