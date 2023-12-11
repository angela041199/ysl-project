<?php
require_once("../do/ysl_connect.php");

$sqlTotal = "SELECT stock.*, product.name FROM stock JOIN product ON stock.product_id = product.id ORDER BY product_id ASC";
$resultTotal = $conn->query($sqlTotal);
$totalUser = $resultTotal->num_rows;
$perPage = 10;
$pageCount = ceil($totalUser / $perPage);

if(isset($_GET["search"])){
    $search= $_GET["search"];
    $sql="SELECT stock.* , product.name FROM stock JOIN product ON stock.product_id = product.id  WHERE name LIKE '%$search%' ";
    
} else if(isset($_GET["page"])){
    $page = $_GET["page"];
    $order = isset($_GET['order']) ? $_GET['order'] : 1;
    switch ($order) {
        case 1: 
            $orderSql = "ORDER BY id DESC";
            break;
        case 2:
            $orderSql = "ORDER BY product_id DESC";
            break;
        default:
            $orderSql = "ORDER BY product_id ASC";
    }

    
  
    $startItem = ($page - 1) * $perPage;
    $sql = "SELECT stock.*, product.name FROM stock JOIN product ON stock.product_id = product.id ORDER BY product_id ASC LIMIT $startItem , $perPage";
} 

else{
    $sql = "SELECT stock.*, product.name FROM stock JOIN product ON stock.product_id = product.id ORDER BY product_id ASC LIMIT 0,$perPage";
}


$result=$conn->query($sql);
$rows = $result ->fetch_all(MYSQLI_ASSOC);


include("../do/css/include.php")
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
       
    </head>
    <style>
        .form-select{
             width: 150px;
    
        }
    </style>
 
    <body class="sb-nav-fixed">
       
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
                        <li><hr class="dropdown-divider" /></li>
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
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
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
                    <div class="container">
                        <div class="d-flex justify-content-between">
                            <div>
                                
                                <a href="stock.php"><button type="button" class="btn btn-secondary mt-4 fs-4">首頁</button></a>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success mt-4 fs-4">新增庫存資料</button>
                            </div>
                        </div>
                        <div class=" mt-4 d-flex justify-content-between ">
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="stock.php?order=1" class="btn btn-secondary fs-6">產品編號<i class="bi bi-arrow-up"></i></a>
                                    <button type="button" class="btn btn-secondary fs-6">產品編號<i class="bi bi-arrow-down"></i></button>
                                   
                                </div>
                                <div class="d-flex  justify-content-between">
                                    <div >
                                    <form action="" method="get" style="margin: 0;">
                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="搜尋..." 
                                        name="search">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                        </form>
                                    </div>
                                    
                                </div>
                        </div>
                        <div class="pt-3">
                            <table class="table table-bordered text-center">
                                <thead class="text-align-center">
                                    <tr>
                                        <th>產品編號</th>
                                        <th>產品名稱</th>
                                        <th>現有庫存</th>
                                        <th>編輯</th>
                                        <th>刪除</th>
                                    </tr>
                                </thead>
                                <?php foreach($rows as $row): ?>
                                <tbody class="text-center">
                                    <tr>
                                        <td><?= $row["id"] ?></td>
                                        <td><?= $row["name"] ?></td>
                                        <td><?= $row["quantity"] ?></td>
                                        <td><a class="btn btn-info text-white" href="edit.php?id=<?= $row["id"] ?>" title="庫存資料">庫存資料<i class="bi bi-info-circle-fill"></i></a></td>
                                        <td><a class="btn btn-danger text-white" href="user.php?id=<?= $row["id"] ?>" title="刪除">刪除<i class="bi bi-info-circle-fill"></i></a></td>
                                    </tr>
                                </tbody>
                                <?php endforeach; ?>
                            </table>
                            <div class="py-2">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
                                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                            <li class="page-item"><a class="page-link" href="stock.php?page=<?= $i ?>"><?= $i ?></a></li>
                                        <?php endfor; ?>
                                        <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                                    </ul>
                                </nav>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
