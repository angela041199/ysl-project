<!doctype html>
<html lang="en">

<head>
    <title>user</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <?php
    include("css.php");
    ?>

</head>

<body>
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">警告</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確定刪除嗎？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <a href="doDeleteUser.php?id=<?=$row["id"]?>" class="btn btn-primary">確認</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <a href="user-list.php" class="btn btn-info mt-3" title="回使用者列表">

            <i class="bi bi-arrow-left"></i>
        </a>
        <?php if ($userCount == 0) : ?>
            <h1>使用者不存在</h1>
        <?php else : ?>
            <form action="doUpdateUser.php" method="post">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <!-- maluco el signo =, me hizo perder el tiempo!!! -->
                <table class="table table-bordered mt-4">

                    <tr>
                        <th>name</th>
                        <td>
                            <input type="text" class="form-control" name="name" value="<?= $row["name"] ?>">


                        </td>
                    </tr>
                    <tr>
                        <th>email</th>
                        <td><input type="text" class="form-control" name="email" value="<?= $row["email"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>phone</th>
                        <td><input type="text" class="form-control" name="phone" value="<?= $row["phone"] ?>"></td>
                    </tr>
                </table>

                <div class="py-2 d-flex justify-content-between">
                    <div>
                        <button class="btn btn-info" type="submit">儲存</button>
                        <a class="btn btn-info" href="user.php?id=<?= $row["id"] ?>">取消</a>
                    </div>
                    <div>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#alertModal" class="btn btn-danger"> 刪除</button>


                        <!-- <a href="doDeleteUser.php?id=
                        //$row["id"] " class="btn btn-danger">刪除</a>  -->
                    </div>
                </div>

            </form>
        <?php endif; ?>
    </div>



    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>