<?php
session_start();


if(isset($_SESSION["admin"])){
    header("../style/admin_index.php");
}


?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>用戶登入</title>
        <link href="css/styles.css" rel="stylesheet" />
      
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <?php include("./css_link.php")?>

        <style>
            body{
                background: url(./images/background_nintendo_switch__2_by_kenji_cosplay_studio_demn0vs-pre.jpg)top center;
            }

            footer{
                /* height: 200px; */
            }
        </style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 mt-4">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><i class="fa-solid fa-user-tie me-2"></i>用戶登入</h3></div>
                                    <div class="card-body">
                                        <form action="doAdLogin.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" type="username" placeholder="管理員帳號..." name="username" >
                                                <label for="username">帳號</label>

                                                
                                                <?php /*var_dump($_SESSION["error"]); */ ?>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" type="password" placeholder="管理員密碼..." name="password" >
                                                <label for="password">密碼</label>
                                            </div>
                                            <?php if(isset($_SESSION["error"]["message"])): ?>
                                                <div class="text-danger">
                                                    <?=$_SESSION["error"]["message"] ?>
                                                </div>
                                            <?php endif; ?>

                                            
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">記住密碼</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">忘記密碼嗎?</a>
                                                <button type="submit" class="btn btn-primary" href="" id="send">登入</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">申請成為管理員</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <!-- <footer class="py-3 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer> -->
            </div>
        </div>
        <?php 
        unset($_SESSION["error"]["message"]);
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

        
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


        <!-- <script>
            const send=document.querySelector("#send"),
            username=document.querySelector("#username"),
            password=document.querySelector("#password")

            send.addEventListener("click", function(){
                console.log("click");
            })

        </script> -->
        
    </body>
</html>
