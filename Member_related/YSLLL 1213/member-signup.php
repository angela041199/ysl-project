<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Sign in</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> -->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>



    <style>
        .bg {
            background: url(./images/background_nintendo_switch__2_by_kenji_cosplay_studio_demn0vs-pre.jpg) top center repeat;
            background-size: cover;
        }

        .container {
            height: 900px;
            /* border-radius: 3%; */
            /* opacity:50; */
        }

        /* .signup-panel {
        background: #ccc;
        width: 260px;

        .logo {
            width: 72px;
        }
    } */

        .birthday_msg{
            font-size:13px;
            color:cadetblue;
        }

        footer {
            /* height: 100px; */
        }
    </style>
</head>

<body class="bg">
    <div class="container bg-light mt-5">
        <div class="d-flex justify-content-center align-items-center">
            <div class="signup-panel">
                <!-- <img class="logo" src="/images/bootstrap-logo.svg" alt=""> -->
                <h1 class="pt-5 text-center">加入會員</h1>
                <form class="row g-3 m-2" action="doSignup.php" method="post">
                    <div class="col-12 mt-3">
                        <label for="name" class="form-label">姓名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="請填寫真實姓名">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="account" class="form-label">帳號</label>
                        <input type="text" class="form-control" id="account" name="account" placeholder="此為日後登入帳號，以及你的會員名稱！">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="此為日後登入密碼">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="repassword" class="form-label">密碼確認</label>
                        <input type="password" class="form-control" id="repassword" name="repassword" placeholder="請再次輸入密碼">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="phone" class="form-label">手機號碼</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="請填寫手機號碼">


                        <div class="col-md-12 mt-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="一個信箱只能申請一支帳號唷！">
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="birthday" class="form-label">生日<span class="birthday_msg">(會在您生日月份送上優惠券喔!)</span></label>
                            <input type="date" class="form-control" id="birthday" name="birthday" placeholder="會在您生日月份送上優惠券喔！">
                        </div>

                        <div class="col-md-12 mt-3">

                            <p>請填寫生理性別</p>

                            <form>
                                <input type="radio" id="gender_f" name="gender" value="female">
                                <label for="gender_f">女</label><br>
                                <input type="radio" id="gender_m" name="gender" value="male">
                                <label for="gender_m">男</label><br>
                                <input type="hidden" value="Submit">
                            </form>

                        </div>

                        <?php if (isset($_SESSION["msg"])) : ?>
                            <div class="col-12 text-danger"><?= $_SESSION["錯誤!"]["msg"] ?></div>
                        <?php endif; ?>

                        <div class="col-12 mt-4 ms-2">

                            <a href="doSignup.php">
                                <button type="submit" class="btn btn-primary me-3">送出</button>
                            </a>
                            <!-- <span class="text-secondary">已有帳號了嗎?</span> -->

                            <a href="admin-login.php" class="" type="">登入</a>

                        </div>
                </form>
            </div>
        </div>

    </div>

    <footer class="text-center mt-5">
        Copyright © Your Switch Life 2023
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
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