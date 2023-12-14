<?php

session_start();
require_once("../includes/connect_sever.php");

include("../style/admin_dashboard.php");
include("../style/admin-nav.php");
include("../style/nav-top-js.php");
include("../style/side-nav-js.php");


// $sql = "SELECT * FROM ysl_seller";
// $result = $conn->query($sql);

// var_dump($result);
$joinsql = "SELECT * FROM ysl_seller JOIN ysl_member ON ysl_seller.seller_id = ysl_member.member_identity";
$joinResult = $conn->query($joinsql);
$sellerCount=$joinResult->num_rows;

$rows = $joinResult->fetch_all(MYSQLI_ASSOC);


?>
<pre>
    <?php
// print_r($rows);
?>
</pre>


<!doctype html>
<html lang="en">

<head>
    <title>賣家資料</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container">
                    <div class="py-2">目前共有<?=$sellerCount?>家店</div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">負責人</th>
                                <th scope="col">店家名</th>
                                <th scope="col">店家編號</th>
                                <th scope="col">成立時間</th>
                                <th scope="col">營運狀態</th>
                                <th scope="col">關店原因</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($sellerCount>0): ?>
                            <?php foreach($rows as $row):?>
                            <tr>
                                <td><?=$row["name"]?></td>
                                <td><?=$row["shop_name"]?></td>
                                <td><?=$row["seller_id"]?></td>
                                <td><?=$row["shop_created_at"]?></td>

                                <td><?php if ($row["seller_valid"]==0):?>
                                    店家關閉中
                                    <?php else:?>
                                    營運中</td>
                                <?php endif; ?>
                                <td><?=$row["close_reason"]?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else:?>
                            目前無店家
                            <?php endif ;?>
                        </tbody>
                    </table>
                </div>
            </main>
            <?php include("../style/footer.php")?>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script> -->
</body>

</html>