<?php
require_once("./db_connect.php");

session_start();

echo $_SESSION['member']['account'];
echo $_SESSION['shop_name'];
?>