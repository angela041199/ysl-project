<?php 

require_once("../connect_server.php");
include("./style/admin-nav.php");
include("./style/admin_dashboard.php");



$sql = "SELECT id, name, account, phone, email, created_at, valid, member_identity FROM ysl_member WHERE valid = 1";

$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>



</head>
<body>
    
<tbody>
                                    <?php foreach ($rows as $row) : ?>
                                        <tr>

                                            <td class="p-1"><?= $row["id"] ?></td>

                                            <td class="p-2"><?= $row["name"] ?></td>
                                            <td class="p-2"><?= $row["account"] ?></td>
                                            <td class="p-1 pe-3"><?= $row["phone"] ?></td>
                                            <td class="p-2"><?= $row["email"] ?></td>
                                            <td class="p-2"><?= $row["created_at"] ?></td>
                                            <td class="p-2 text-center">
                                                <a href="memberProfile.php?id=<?= $row["id"] ?>">
                                                    <button class="btn btn-secondary ">
                                                        <?php
                                                        if ($row["valid"] == 1) {
                                                            echo "正常";
                                                        } else {
                                                            echo "暫停";
                                                        }

                                                        ?>
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="doDelete.php" method="POST">
                                                    <input type="hidden" name="id" value="<?= $row["id"]; ?>">
                                                    <input type="hidden" name="name" value="<?= $row["name"]; ?>">

                                                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#alertModal<?= $row["id"] ?>">冷凍</button>

                                                         <div class="modal fade" id="alertModal<?= $row["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">注意</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        確定冷凍<?= $row["name"] ?>嗎？
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                                        <a href="doDelete.php?id=<?= $row["id"] ?>" class="btn btn-primary">確認</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                


                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>