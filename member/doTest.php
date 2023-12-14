<?php
require_once("../db_connect.php");
// session_start();

if(!isset($_POST["email"])){
    echo "請循正常管道進入此頁面";
    exit;
}

$email=$_POST["email"];
$password=$_POST["password"];

?>