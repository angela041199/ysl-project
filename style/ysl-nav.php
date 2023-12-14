<style>
.navbg {
    background: url(../style/img/background_nintendo_switch__2_by_kenji_cosplay_studio_demn0vs-pre.jpeg);
}
.ob_fit{
    object-fit: contain;
    width: 100%;
    height: 100%;
}
#logo{
    display: inline-block;
    width: 100px;
}
</style>

<nav class="sb-topnav navbar navbar-expand navbg">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 text-white" id="logo" href="../seller/seller_dashboard.php"><img class="ob_fit" src="../style/img/ysl-logo-button-whiteborder.png" alt="LOGO"></a>  
    <!-- Sidebar Toggle-->
    <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button> -->
    <div class="text-light d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">HELLO !
        <?= $_SESSION["member"]['name']?></div>
    <!-- Navbar Search-->
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="../product/doLogOut.php">登出</a></li>
            </ul>
        </li>
    </ul>
</nav>