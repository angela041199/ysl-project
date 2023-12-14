<?php
session_start();
?>
 
 <head>
 <style>
.navbg {  
    /* background: #FF482F; */
    background: url(../style/img/background__blue.jpg);
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
 </head>


 <nav class="sb-topnav navbar navbar-expand navbg">
     <!-- Navbar Brand-->
     <a class="navbar-brand ps-3 text-white" id="logo" href="../seller/seller_dashboard.php"><img class="ob_fit" src="../style/img/ysl-logo-button-whiteborder.png" alt="LOGO"></a>  
     <!-- Sidebar Toggle-->
     <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button> -->
     <div class="text-light d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">HELLO !
         <?php  echo $_SESSION["admin"]['name']?></div>
     <!-- Navbar Search-->
     <!-- Navbar-->
     <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
         <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                 aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                 <li><a class="dropdown-item" href="../member/admin-login.php">Logout</a></li>
             </ul>
         </li>
     </ul>
 </nav>

 <!-- Bootstrap JavaScript Libraries -->
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
     integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
 </script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
     integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
 </script>