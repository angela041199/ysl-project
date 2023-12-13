<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Sign up</title>
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
        height: 580px;
    }

    /* .signup-panel {
        background: #ccc;
        width: 260px;

        .logo {
            width: 72px;
        }
    } */
    </style>
</head>

<body class="bg">
    <div class="container bg-light mt-5">
        <div class="d-flex justify-content-center align-items-center">
            <div class="signup-panel">
                <h1 class="pt-5 text-center">會員註冊</h1>
                <form class="row g-3 m-2" action="./doSignUp.php" method="post">
                    <div class="col-12">
                        <label for="shop_name" class="form-label">商店名稱 *</label>
                        <input type="text" class="form-control" id="shop_name" name="shop_name" placeholder="請填寫商家名稱">
                    </div>
                    <div class="col-md-12">
                        <label for="sub_email" class="form-label">聯絡信箱 *</label>
                        <input type="email" class="form-control" id="sub_email" name="sub_email" placeholder="請填寫常用信箱">
                    </div>
                    <div class="col-md-12">
                        <div>性別</div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1"
                                value="male">
                            <label class="form-check-label" for="flexRadioDefault1">
                                男
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2"
                                value="female" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                女
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="address" class="form-label">地址 *</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="請填寫通訊地址">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkEmail">
                        <label class="form-check-label" for="checkEmail">
                            與會員信箱相同
                        </label>
                    </div>

                    <div class="col-md-12">
                        <label for="address" class="form-label">生日 *</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="請填寫通訊地址">
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
    <!-- <script>
    const send = document.querySelector("#send"),
        email = document.querySelector("#email"),
        name = document.querySelector("#name"),
        password = document.querySelector("#password"),
        repassword = document.querySelector("#repassword")

    send.addEventListener("click", function() {
        // console.log("click");
        let emailValue = email.value;
        let nameValue = name.value;
        let passwordValue = password.value;
        let repasswordValue = repassword.value

        let data = {
            email: emailValue,
            name: nameValue,
            password: passwordValue,
            repassword: repasswordValue
        }

        // console.log(data);
        $.ajax({
                method: "POST", //or GET
                url: "/api/sign-up.php",
                dataType: "json",
                data: data
            })
            .done(function(response) {
                // console.log(response);
                let status = response.status;
                if (status == 0) {
                    alert(response.message)
                } else {
                    alert(response.message)
                }

            }).fail(function(jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);
            });

    })
    </script> -->
</body>


</html>