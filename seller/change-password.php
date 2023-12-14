<?php
session_start();
$msg = $_SESSION["msg"];
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
    <title>修改密碼</title>
    <link href="../style/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
    .eye {
        right: 30px;
        top: 173px;
        cursor: pointer;
    }

    .invalid {
        color: red;
    }

    .invalid::before {
        content: "\26A0";
    }

    .valid {
        color: green;
    }

    .valid::before {
        content: "\2713";
    }

    #rule {
        display: none;
    }
    </style>
</head>

<body class="sb-nav-fixed">

    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"> -->
                    <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">!!!注意!!!</h1> -->
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button> -->
                <!-- </div>
                <div class="modal-body">
                    新密碼設定成功 ! <br> 請重新登入
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">確認</button>
                </div>
            </div>
        </div>
    </div> -->
    <div id="layoutSidenav">

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">商家管理</h1>
                    <!-- 麵包屑 -->
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="seller_dashboard.php">首頁</a></li>
                            <li class="breadcrumb-item active" aria-current="page">商家管理-修改密碼</li>
                        </ol>
                    </nav>

                    <div class="card mb-4">
                        <div class="card-body h2 pb-0">
                            修改密碼
                        </div>

                        <form class="row g-3 m-2" method="post" action="do_change-pswd.php" id="myForm">
                            <div class="card-body h5 py-0">
                                <i class="bi bi-person-fill-lock pe-1"></i>密碼變更
                            </div>
                            <div class="col-12 ">
                                <label for="psw" class="form-label">原始密碼 *</label>
                                <input type="password" class="form-control position-relative" id="psw" name="psw"
                                    placeholder="請輸入原始密碼">
                                <i class="bi bi-eye-fill position-absolute eye h5" id="togglepsw"></i>
                            </div>

                            <div class="col-12">
                                <label for="n_psw" class="form-label">新密碼 *</label>
                                <input type="password" class="form-control" id="n_psw" name="n_psw"
                                    placeholder="請輸入新密碼">
                            </div>
                            <div class="col-12">
                                <label for="re_n_psw" class="form-label">確認密碼 *</label>
                                <input type="password" class="form-control" id="re_n_psw" name="re_n_psw"
                                    placeholder="請再次輸入新密碼">
                            </div>
                            <div>
                                <div class="text-danger"><?=$_SESSION["msg"]?></div>

                                <div class="" id="rule">
                                    <div class="invalid" id="uppercase">至少1個大寫字母</div>
                                    <div class="invalid" id="lowercase">至少1個小寫字母</div>
                                    <div class="invalid" id="length">至少6個字母/數字</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary" id="submitBtn">確認更改</button>
                            </div>


                        </form>

                    </div>

                </div>

            </main>
            <?php include("../style/footer.php")?>
        </div>
    </div>
    <?php
        unset($_SESSION["msg"]);
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="assets/demo/chart-pie-demo.js"></script> -->

    <script>
    const psw = document.querySelector("#psw"),
        togglepsw = document.querySelector("#togglepsw");
    togglepsw.addEventListener("click", function(e) {
        const type = psw.getAttribute("type") === "password" ? "text" : "password";
        psw.setAttribute("type", type);
        // psw.className("bi-eye-fill") == ("bi-eye-slash");
        this.classList.toggle("bi-eye-slash-fill");
    })
    </script>
    <script>
    const n_psw = document.querySelector("#n_psw"),
        uppercase = document.querySelector("#uppercase"),
        lowercase = document.querySelector("#lowercase"),
        length = document.querySelector("#length");

    n_psw.onfocus = function() {
        document.getElementById("rule").style.display = "block";
    }
    n_psw.onblur = function() {
        document.getElementById("rule").style.display = "none";
    }
    n_psw.onkeyup = function() {
        let lowerLetter = /[a-z]/g;
        if (n_psw.value.match(lowerLetter)) {
            lowercase.classList.remove("invalid");
            lowercase.classList.add("valid");
        } else {
            lowercase.classList.remove("valid");
            lowercase.classList.add("invalid");
        }
        let upperLetter = /[A-Z]/g;
        if (n_psw.value.match(upperLetter)) {
            uppercase.classList.remove("invalid");
            uppercase.classList.add("valid");
        } else {
            uppercase.classList.remove("valid");
            uppercase.classList.add("invalid");
        }
        if (n_psw.value.length >= 6) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }
    </script>

    <!-- <script>
    const myModal = new bootstrap.Modal('#exampleModal')
    myModal.show()
    </script> -->

</body>

</html>