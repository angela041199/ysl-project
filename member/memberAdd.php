<?php
require_once("../connect_server.php");
include("./style/admin-nav.php");
include("./style/admin_dashboard.php");


// $sql = "SELECT id, name, account, phone, email, created_at, valid, member_identity FROM ysl_member WHERE valid IN (0, 1)";

// $result = $conn->query($sql);
// $rows = $result->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>member-admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>


    <?php include("../css_link.php") ?>

</head>

<body class="sb-nav-fixed">
    
       
    <div id="layoutSidenav">
    
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <ol class="breadcrumb mb-4  mt-3">
                        <li class="breadcrumb-item"><a href="index.php">YSL後台</a></li>
                        <li class="breadcrumb-item active">新增會員</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            歡迎來到 YSL 的會員後台，您的專屬空間。我們為您提供了一個有效的工具，以確保每一位會員都能享受到尊榮的購物體驗。

                        </div>

                    </div>
                    
                    <div class="card mb-4">
                      
                        <div class="card-body">
                        <h1 class="pt-5 text-center">新增會員資料</h1>
                <form class="row g-3 m-2" action="doSignup.php" method="post">
                    <div class="col-12 mt-3">
                        <label for="name" class="form-label">姓名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="請填寫真實姓名">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="account" class="form-label">帳號</label>
                        <input type="text" class="form-control" id="account" name="account" placeholder="請填寫登入帳號">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="請填寫登入密碼">
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
                            <input type="email" class="form-control" id="email" name="email" placeholder="請填寫主要信箱">
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="birthday" class="form-label">生日</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" placeholder="請填西元出生年月日">
                        </div>

                        <div class="col-md-12 mt-3">

                            <p>請填寫生理性別</p>

                            <!-- <form> -->
                                <input type="radio" id="gender_f" name="gender" value="female">
                                <label for="gender_f">女</label><br>
                                <input type="radio" id="gender_m" name="gender" value="male">
                                <label for="gender_m">男</label><br>
                                <input type="hidden" value="Submit">
                            <!-- </form> -->

                        </div>

                        

                        <div class="col-12 mt-4 ms-2">

                            <a href="doAddup.php">
                                <button type="submit" class="btn btn-primary me-3">送出</button>
                            </a>
                            <!-- <span class="text-secondary">已有帳號了嗎?</span> -->

                            <!-- <a href="admin-login.php" class="" type="">登入</a> -->

                        </div>
                </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                
                <?php include("./style/footer.php")?>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>