<?php
require("../includes/connect_sever.php");
$id=$_GET["id"];
$sql = "SELECT stock.*, product.name FROM stock JOIN product ON stock.product_id = product.id WHERE stock.product_id=$id";

$result=$conn->query($sql);

$row=$result->fetch_assoc();


$userCount = $result->num_rows;



include("../stock/css/include.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
            
        />
      
    </head>

    <body>
    <div class="container">
        <div class="py-2">
        <a class="btn btn-info text-white" href="stock.php" title="回使用者列表"><i class="bi bi-arrow-left"></i></a>
        </div>
        <?php if($userCount ==0): ?>
            <h1>使用者不存在</h1>
        <?php else: ?>
        <form action="UpdateStock.php" method="post">
            <table class="table table-bordered ">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <tr>
                    <th class="text-center">庫存序號</th>
                    <td><?= $row["id"] ?></td>
                </tr>
                <tr>
                    <th class="text-center">商品名稱</th>
                    <td><?= $row["name"] ?></td>
                </tr>
                <tr>
                    <th class="text-center">數量</th>
                    <td><input type="number" class="form-control" name="quantity"
                        value="<?= $row["quantity"] ?>"
                        ></td>
                </tr>
            </table>
            <div class="py-2">
                <button type="submit" title="修改資料" class="btn btn-info text-white">修改資料</button>
            </div>
        </form>
        <?php endif ; ?>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>

