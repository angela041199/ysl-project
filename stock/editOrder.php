<?php 
require_once("../do/ysl_connect.php");
$id=$_GET["id"];
$sql = "SELECT  orders.*, product.name, ysl_member.name, product.name AS product_name FROM orders JOIN product ON orders.product_id = product.id JOIN ysl_member ON orders.member_id = ysl_member.id WHERE orders.product_id = $id";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
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

    <body style="background-color: lightgray;"> 
    <div class="container">
        <header>
            <div class="text-center pt-5"><h1>訂單狀態更新</h1></div>

            <a href="order.php" class="btn btn-success  "><h3 class="m-0">返回</h3></a>
        </header>
        <main >
           
                <?php switch($row['status']){
                    case 1 :
                        $new_status = "已出貨";
                         break;
                    case 2 :
                        $new_status = "待出貨";
                        break;
                    case 3 :
                         $new_status = "訂單取消";
                        break;
                     case 4 :
                        $new_status = "下訂完成";
                        break ;
                     default:
                        $new_status = "未知狀態";
                        break;
                                }
                ?>
            <form action="updateOrder.php" method="post">
                <table class="table mt-3">
                    <thead>
                        <tr>
                        <th scope="col">
                            <h3>訂單編號 :</h3>
                            <h1><?= $row["id"] ?></h1>
                        </th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td scope="row" class="fs-5" >購買會員：<?= $row["name"] ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td scope="row" class="fs-5" >購買商品：<?= $row["product_name"] ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td scope="row" class="fs-5" >訂單總價：<?= $row["price"] ?> </td>
                        <td colspan="2"></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td scope="row" class="fs-5" >成立時間：<?= $row["create_at"] ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td scope="row" class="fs-5" >訂單狀態：
                            <form action="updateOrder.php" method="post" >
                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option selected><?= $new_status ?></option>
                                <option value="1">已出貨</option>
                                <option value="2">待出貨</option>
                                <option value="3">訂單取消</option>
                                <option value="4">下訂完成</option>
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td class="d-flex ">
                            <button type="submit" title="修改資料" class="btn btn-secondary mx-2" >更改</button>
                            <a href="order.php" class="btn btn-secondary">取消</a>
                        </td>
                        <td colspan="2"></td>
                        <td></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
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
