<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
<link href="./css/styles.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

<style>
.navbg {
    /* background: #FF482F; */
    background: url(../style/img/background__blue.jpg);
}
</style>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light shadow" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">                    
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="../style/admin_index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        首頁
                    </a>
                    <div class="sb-sidenav-menu-heading">MANAGE</div>

                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#colla"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="bi bi-person-rolodex"></i></div>
                        會員管理
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="colla" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../member/member-admin.php">會員資料</a>
                            <a class="nav-link"
                                href="../seller/seller-list.php">賣家資料</a>
                            <a class="nav-link" href="../member/memberAdd.php">新增會員</a>
                            <a class="nav-link" href="../member/member-deleted-list.php">被冷凍的會員</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                        行銷管理
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../coupons/coupon-list.php">優惠券列表</a>
                            <a class="nav-link"
                                href="../coupons/add-coupon.php">新增優惠券</a>
                        </nav>
                    </div>



                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapse"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="bi bi-pencil-square"></i></div>
                        文章管理
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../articles/article-list.php">文章列表</a>
                            <a class="nav-link" href="../articles/create-article.php">新增文章</a>
                        </nav>
                    </div>

                </div>
            </div>
        </nav>
    </div>

</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script> -->
<!-- <script src="js/scripts.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script> -->
<!-- <script src="js/datatables-simple-demo.js"></script> -->