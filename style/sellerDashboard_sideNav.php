<!-- Bootstrap CSS v5.2.1 -->
<!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> -->
<link href="./css/styles.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">  
        <nav class="sb-sidenav accordion sb-sidenav-light shadow" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="../seller/seller_dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        首頁
                    </a>
                    <div class="sb-sidenav-menu-heading">Seller</div>
                    <a class="nav-link collapsed" href="../product/product_list.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        商品管理
                    </a>
                    <a class="nav-link collapsed" href="../product/type.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        類別管理
                    </a>
                    <a class="nav-link collapsed" href="../stock/stock.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        庫存管理
                    </a>
                    <a class="nav-link collapsed" href="../stock/order.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-card-checklist"></i></div>
                        訂單管理
                    </a>

                    <div class="sb-sidenav-menu-heading">Shop</div>
                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        商家管理
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../seller/change-password.php">修改密碼</a>
                            <a class="nav-link" href="../seller/close-shop.php">關閉店家</a>
                        </nav>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>