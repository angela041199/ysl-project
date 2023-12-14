<?php 
session_start();
$seller_id = $_SESSION["seller_id"];
require_once("../includes/connect_sever.php");
$sql = "SELECT  orders.*, product.name, ysl_member.name, product.name AS product_name FROM orders JOIN product ON orders.product_id = product.id JOIN ysl_member ON orders.member_id = ysl_member.id ORDER BY product_id ASC;";

$sqlTotal = "SELECT  orders.*, product.name, ysl_member.name, product.name AS product_name FROM orders JOIN product ON orders.product_id = product.id JOIN ysl_member ON orders.member_id = ysl_member.id ORDER BY product_id ASC";
$resultTotal = $conn->query($sqlTotal);
$totalUser = $resultTotal->num_rows;
$perPage = 6;
$pageCount = ceil($totalUser / $perPage);

if(isset($_GET["search"])){
    $search= $_GET["search"];
    $sql = "SELECT  orders.*, product.name, ysl_member.name, product.name AS product_name FROM orders JOIN product ON orders.product_id = product.id JOIN ysl_member ON orders.member_id = ysl_member.id WHERE ysl_member.name LIKE '%$search%' OR product.name LIKE '%$search%' ";
    
}else if(isset($_GET["page"])){
    $page=$_GET["page"];
    $startItem=($page-1)*$perPage;
    $sql = "SELECT  orders.*, product.name, ysl_member.name, product.name AS product_name FROM orders JOIN product ON orders.product_id = product.id JOIN ysl_member ON orders.member_id = ysl_member.id ORDER BY product_id ASC LIMIT $startItem , $perPage";
}else{
    // $page=1;
    $sql = "SELECT  orders.*, product.name, ysl_member.name, product.name AS product_name FROM orders JOIN product ON orders.product_id = product.id JOIN ysl_member ON orders.member_id = ysl_member.id ORDER BY product_id ASC LIMIT 0 , $perPage";
}
 
$result=$conn->query($sql);
$rows = $result ->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <style>
         .form-control{
            width: auto;
         }
    </style>
    <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
           <?php include("../style/ysl-nav.php") ; ?>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
       <?php include("../style/sellerDashboard_sideNav.php"); ?>
               
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container">
                        <div class="d-flex justify-content-center pt-5"><h1>訂單列表</h1></div>
                        <?php $userCount = $result->num_rows; ?>
                        <h5 style="letter-spacing: 3px;">全部資料 : <?= $userCount ?>筆</h5>
                    </div>

                    <nav class="navbar navbar-light ">
                        <div class="container d-flex justify-content-center pt-3 ">
                            <form class="d-flex" >
                            <input style="width: auto;" class="form-control me-2" type="search" name="search" placeholder="搜尋..." aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">搜尋</button>
                            </form>
                        </div>
                    </nav>
                    <table class="table table-bordered text-center">
                                <thead class="text-align-center">
                                    <tr>
                                        <th>產品編號</th>
                                        <th>產品名稱</th>
                                        <th>價格</th>
                                        <th>購買人</th>
                                        <th>訂單成立時間</th>
                                        <th>訂單狀態</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <?php foreach($rows as $row): ?>
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
                                <tbody class="text-center">
                                    <tr>
                                        <td><?= $row["id"] ?></td>
                                        <td><?= $row["product_name"] ?></td>
                                        <td><?= $row["price"] ?></td>
                                        <td><?= $row["name"] ?></td>
                                        <td><?= $row["create_at"] ?></td>
                                        <td><?=$new_status ?></td>
                                        <td><a class="btn btn-success text-white" href="editOrder.php?id=<?= $row["id"] ?>" title="編輯">編輯<i class="bi bi-info-circle-fill"></i></a></td>
                                    </tr>
                                </tbody>
                                <?php endforeach; ?>
                            </table>
                            <div class="py-2 d-flex justify-content-center">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
                                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                            <li class="page-item"><a class="page-link" href="order.php?page=<?= $i ?>"><?= $i ?></a></li>
                                        <?php endfor; ?>
                                        <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                                    </ul>
                                </nav>
                            </div>
                </main>
                   
            
                <footer class="py-4 bg-light mt-auto">
                <?php include("../style/footer.php"); ?>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
