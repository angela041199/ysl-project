<style>
.navbg {
    /* background: #FF482F; */
    background: url(./img/background_nintendo_switch__2_by_kenji_cosplay_studio_demn0vs-pre.jpeg);
}
</style>

<nav class="sb-topnav navbar navbar-expand navbg">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 text-white" href="index.html">Your Switch Life</a>
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
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#!">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>