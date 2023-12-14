<?php
// 开始会话
session_start();

// $_SESSION['seller_id']=$seller_id;

// if (!isset($_SESSION['shop_name'])) {
//     header("Location: signup.php");
//     exit();
// }
include("../style/sellerDashboard_sideNav.php");
include("../style/ysl-nav.php");
include("../style/nav-top-js.php");
include("../style/side-nav-js.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>賣家管理後台</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> -->
    <link href="../style/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script> -->
</head>

<body class="sb-nav-fixed">

    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-5">
                    <h1 class="mt-4"> <?=$_SESSION['shop_name']?> - 管理後台
                    </h1>
                    <img src="./img/bg.jpg" alt="">
                </div>
            </main>
            <?php include("../style/footer.php")?>
        </div>
    </div>
    <?php
        // unset($_SESSION['shop_name']);
    ?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script> -->
</body>

</html>