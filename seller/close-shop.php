<?php
session_start();
// if (!isset($_SESSION['seller_id'])) {
//     header("Location: signup.php");
//     exit();
// }


// if (isset($_GET['seller_id'])) {
//     $user_id_from_url = $_GET['seller_id'];


//     echo "用户ID来自URL： " . $user_id_from_url;
// } else {
//     echo "未提供用户ID";
// }
include("../style/sellerDashboard_sideNav.php");
include("../style/ysl-nav.php");
include("../style/nav-top-js.php");
include("../style/side-nav-js.php");

require_once("../includes/connect_sever.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>關閉店家</title>
    <link href="../style/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">商家管理</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="seller_dashboard.php">首頁</a></li>
                        <li class="breadcrumb-item active">商家管理-關閉店家</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body h2 pb-0">
                            關閉店家
                        </div>

                        <form class="row g-3 m-2" method="post" action="./doClose-shop.php">
                            <div class="card-body h5 py-0">
                                <i class="bi bi-bag-x-fill pe-1"></i></i>關閉原因
                            </div>
                            <textarea name="close_reason" id="close_reason" cols="30" rows="10"></textarea>
                            <div class="col-12">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    我想關店
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">!!!注意!!!</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            您確定要關閉<?=$_SESSION['shop_name']?>嗎？
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">取消</button>
                                            <button type="submit" class="btn btn-primary">確認</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </main>
            <?php include("../style/footer.php")?>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="assets/demo/chart-pie-demo.js"></script> -->

    <script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })
    </script>
</body>

</html>