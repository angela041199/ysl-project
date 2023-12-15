<?php
session_start();



?>

<!doctype html>
<html lang="en">

<head>
    <title>memberSignup</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />


    <style>
        body {
            background: url(./images/background_nintendo_switch__2_by_kenji_cosplay_studio_demn0vs-pre.jpg);
            /* background-repeat: no-repeat; */
            /* background-position: center; */
            /* Center the image */
        }
    </style>

    <?php include("../includes/css_link.php") ?>
</head>

<body>
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start">
        <style>
            .cascading-right {
                margin-right: -50px;
            }

            @media (max-width: 991.98px) {
                .cascading-right {
                    margin-right: 0;
                }
            }

            #card-login {

                background: hsla(0, 0%, 100%, 0.55);
                backdrop-filter: blur(30px);
            }
        </style>

        <!-- Jumbotron -->
        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card cascading-right" id=card-login>
                        <div class="card-body p-5 shadow-5 text-center mt-5">
                            <?php if (isset($_SESSION['success_message'])) : ?>
                                <div class="fs-3 text-success mb-3">
                                    <?= $_SESSION['success_message'] ?>
                                </div>
                                <?php unset($_SESSION['success_message']); ?>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['error_message'])) : ?>
                                <div class="fs-3 text-danger mb-3">
                                    <?= $_SESSION['error_message'] ?>
                                </div>
                                <?php unset($_SESSION['error_message']); ?>
                            <?php endif; ?>

                            <h2 class="fw-bold mb-4"><i class="fa-solid fa-gamepad me-2"></i>申請成為會員</h2>

                            <p class="text-secondary">以下皆為必填欄位</p>
                            <form action="doSignUpNew.php" method="post">
                                
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">

                                            <label class="form-label fw-normal fs-5" for="form3Example1">姓名</label>
                                            <input type="text" id="form3Example1" class="form-control" name="name" placeholder="請填寫真實姓名" value="<?= isset($_SESSION['name_buyer']) ? htmlspecialchars($_SESSION['name_buyer']) : '' ?>">

                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label fw-normal fs-5" for="form3Example2">帳號</label>
                                            <input type="text" id="form3Example2" class="form-control" name="account" placeholder="此為日後登入帳號，以及你的會員名稱" value="<?= isset($_SESSION['account_buyer']) ? htmlspecialchars($_SESSION['account_buyer']) : '' ?>">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Email input -->
                                    <!-- <div class="col-md-6 mb-4"> -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label fw-normal fs-5" for="form3Example3">Email</label>
                                        <input type="email" id="form3Example3" class="form-control" name="email" placeholder="一個信箱只能申請一支帳號唷" value="<?= isset($_SESSION['email_buyer']) ? htmlspecialchars($_SESSION['email_buyer']) : '' ?>">

                                    </div>
                                    <!-- </div> -->

                                    <!-- <div class="col-md-6 mb-4">
                                        <div class="form-outline mb-4">
                                            <label class="form-label fw-normal fs-5" for="form3Example3">生日<span class="birthday_msg fs-6">(會在您生日月份送上優惠券喔!)</span></label>
                                            <input type="email" id="form3Example3" class="form-control" name="birthday" placeholder="會在您生日月份送上優惠券喔！">

                                        </div>
                                    </div> -->
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label fw-normal fs-5" for="form3Example4">密碼</label>
                                    <input type="password" id="form3Example4" class="form-control" name="password" placeholder="此為日後登入密碼">

                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label fw-normal fs-5" for="form3Example4">密碼確認</i></label>
                                    <input type="password" id="form3Example4" class="form-control" name="repassword" placeholder="請再次輸入密碼">

                                </div>

                                <?php if (isset($_SESSION["error"]["message_member"])) : ?>
                                    <div class="text-danger mb-3">
                                        <?= $_SESSION["error"]["message_member"] ?>
                                    </div>
                                <?php endif; ?>


                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary me-3">送出</button>


                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 mt-2">
                    <img src="./images/Tech-Talk-nintendo-hero.webp" class="w-100 rounded-4 shadow-4" alt="" />
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->

    <?php
    unset($_SESSION["error"]["message_member"]);
    ?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>