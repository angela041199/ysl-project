<?php
session_start();


include("../style/admin_dashboard.php");
include("../style/admin-nav.php");

if (!isset($_SESSION["admin"])) {
    header("location:admin-login.php");
}


// include("../style/nav-top-js.php");
// include("../style/side-nav-js.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>管理員後台</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> -->
    <link href="../style/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">

    <style>
        .index-title {
            font-family: Silkscreen;
            letter-spacing: 10px;
            font-weight: 400;
            font-size: 70px;
            color: #FF482F;
        }
    </style>
</head>

<body class="sb-nav-fixed">

    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-5 text-center">
                    <h1 class="index-title">WELCOME!</h1>
                    <img src="./img/bg.jpg" alt="">
                </div>
            </main>
            <?php include("../style/footer.php"); ?>
        </div>
    </div>
    <?php
    unset($_SESSION["error"]["message"]);
    ?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script> -->
</body>

</html>