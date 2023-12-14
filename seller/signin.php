<?php
session_start();

require_once("./includes/connect_sever.php");

?>
<!doctype html>
<html lang="en">

<head>
    <title>Sign in</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    .bg {
        background: url(./img/background_nintendo_switch__2_by_kenji_cosplay_studio_demn0vs-pre.jpeg) top center no-repeat;
        background-size: cover;
    }

    .container {
        height: 560px;
        border-radius: 50px;
    }

    .formWidth {
        width: 600px;
    }
    </style>
</head>

<body class="bg ">
    <div class="container bg-light mt-5">
        <div class="mx-auto formWidth">
            <div class="signup-panel">
                <h1 class="pt-5 text-center">會員登入</h1>
                <form class="row g-3 m-2" action="./do_signin.php" method="post">
                    <div class="col-12">
                        <label for="account" class="form-label">帳號</label>
                        <input type="text" class="form-control" id="account" name="account" placeholder="請輸入帳號">
                    </div>

                    <div class="col-md-12">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="請輸入密碼">
                    </div>

                    <?php if(isset($_SESSION["msg"])): ?>
                    <div class="mt-2 text-danger"><?=$_SESSION["msg"]?></div>
                    <?php endif; ?>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary me-3">確認</button>
                        <!-- <a type="submit" class="btn btn-info">確認</a> -->
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center py-5">
            Copyright © Your Switch Life 2023
        </div>
    </div>
    <?php
        unset($_SESSION["msg"]);
    ?>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

</body>


</html>