<?php

$a = null;
$b = 1;
$c = "";
$d = 0;

var_dump(isset($b, $a));
var_dump(isset($c, $d));

?>

<form action="doTest.php" method="POST">
    <div class="input-area">
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Password</label>
        </div>
    </div>
    <?php if (isset($_SESSION["error"]["message"])) : ?>
        <div class="mt-2 text-danger">
            <?= $_SESSION["error"]["message"] ?>
        </div>
    <?php endif; ?>
    <div class="py-2">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Remember me
            </label>
        </div>
    </div>
    <div class="d-grid mb-4">
        <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
</form>