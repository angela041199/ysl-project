<?php

session_start();

$_SESSION = array();

session_destroy();

// 導向到登入頁面）
header("location:../member/admin-login.php");
exit();
?>
