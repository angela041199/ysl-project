<?php
require_once("../do/ysl_connect.php");

$sqlTotal = "SELECT stock.*, product.name FROM stock JOIN product ON stock.product_id = product.id ORDER BY product_id ASC";
$resultTotal = $conn->query($sqlTotal);
$totalUser = $resultTotal->num_rows;
$perPage = 10;
$pageCount = ceil($totalUser / $perPage);

if(isset($_GET["search"])){
    $search= $_GET["search"];
    $sql="SELECT stock.* , product.name FROM stock JOIN product ON stock.product_id = product.id  WHERE name LIKE '%$search%'";
    
} else if(isset($_GET["page"])  && isset($_GET["order"])){
    $page = $_GET["page"];
    $order=$_GET["order"];
    switch($order){
      case 1 :
        $orderSql=" stock.id ASC";
        break;
      case 2:
        $orderSql="stock.id DESC";
        break;
        default:
        $orderSql="id ASC";
      
    }

    $startItem = ($page - 1) * $perPage;

    $sql = "SELECT stock.*, product.name FROM stock JOIN product ON stock.product_id = product.id ORDER BY $orderSql LIMIT $startItem , $perPage";
} 

else{
    $page=1;
    $order=1;
    $sql = "SELECT stock.*, product.name FROM stock JOIN product ON stock.product_id = product.id ORDER BY product_id ASC LIMIT 0,$perPage";
}



$result=$conn->query($sql);
$rows = $result ->fetch_all(MYSQLI_ASSOC);


include("../do/css/include.php")
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
       <?php include("../do/style/sellerDashboard_sideNav.php");
            include("../do/style/ysl-nav.php") ;
            
       ?>
    </head>
    <style>
        .form-select{
             width: 150px;
    
        }
    </style>
 
    <body class="sb-nav-fixed">
       
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
           <?php include("../do/style/ysl-nav.php") ; ?>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
       <?php include("../do/style/sellerDashboard_sideNav.php"); ?>
               
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container">
                        <div class="d-flex justify-content-between">
                            <div>
                                
                                <a href="stock.php"><button type="button" class="btn btn-secondary mt-4 fs-4">首頁</button></a>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success mt-4 fs-4">新增庫存資料</button>
                            </div>
                        </div>
                        <div class=" mt-4 d-flex justify-content-between ">
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="stock.php?page=<?=$page?>&order=1" class="btn btn-secondary fs-6">產品編號<i class="bi bi-arrow-up"></i></a>
                                    <a href="stock.php?page=<?=$page?>&order=2" type="button" class="btn btn-secondary fs-6">產品編號<i class="bi bi-arrow-down"></i></a>
                                   
                                </div>
                                <div class="d-flex  justify-content-between">
                                    <div >
                                    <form action="" method="get" style="margin: 0;">
                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="搜尋..." 
                                        name="search">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                        </form>
                                    </div>
                                    
                                </div>
                        </div>
                        <div class="pt-3">
                            <table class="table table-bordered text-center">
                                <thead class="text-align-center">
                                    <tr>
                                        <th>產品編號</th>
                                        <th>產品名稱</th>
                                        <th>現有庫存</th>
                                        <th>編輯</th>
                                        <th>刪除</th>
                                    </tr>
                                </thead>
                                <?php foreach($rows as $row): ?>
                                <tbody class="text-center">
                                    <tr>
                                        <td><?= $row["id"] ?></td>
                                        <td><?= $row["name"] ?></td>
                                        <td><?= $row["quantity"] ?></td>
                                        <td><a class="btn btn-info text-white" href="editStock.php?id=<?= $row["id"] ?>" title="庫存資料">庫存資料<i class="bi bi-info-circle-fill"></i></a></td>
                                        <td><a class="btn btn-danger text-white" href="user.php?id=<?= $row["id"] ?>" title="刪除">刪除<i class="bi bi-info-circle-fill"></i></a></td>
                                    </tr>
                                </tbody>
                                <?php endforeach; ?>
                            </table>
                            <div class="py-2">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
                                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                            <li class="page-item"><a class="page-link" href="stock.php?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a></li>
                                        <?php endfor; ?>
                                       
                                        <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                     </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                <?php include("../do/style/footer.php"); ?>
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