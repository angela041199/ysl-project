<?php
require_once("../db_connect.php");

$hashedPassword = password_hash('159357', PASSWORD_DEFAULT);

$sql = "INSERT INTO `ysl admin` (username, password) VALUES ('admin', '$hashedPassword')";
 	 

if ($conn->query($sql) === TRUE) {
    	echo "新資料輸入成功";
} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
}




?>